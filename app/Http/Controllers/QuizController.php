<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionDetail;
use App\Models\QuestionDone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    function index() {
        return view('pages.quiz.index', [
            'quizzes' => Question::query()->withCount('questionDetails')->get()
        ]);
    }

    function create() {
        return view('pages.quiz.create');
    }

    function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'e' => 'required',
            'correct_answer' => 'required',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $question = Question::create([
                    'title' => $request->title
                ]);

                $question->questionDetails()->create([
                    'photo' => $request->hasFile('photo') ? $request->file('photo')->store('pictures', 'public') : null,
                    'question' => $request->question,
                    'a' => $request->a,
                    'b' => $request->b,
                    'c' => $request->c,
                    'd' => $request->d,
                    'e' => $request->e,
                    'correct_answer' => $request->correct_answer,
                    'explain' => $request->hasFile('explain') ? $request->file('explain')->store('pictures', 'public') : null,
                ]);
            });

            return redirect('/quizzes');
        } catch (\Throwable $th) {
            return redirect('/quizzes')->with(['message' => $th->getMessage()]);
        }
    }

    function detail($id) {
        $quiz = Question::query()->withCount('questionDetails')->where('id', $id)->first();

        return view('pages.quiz.detail', [
            'quiz' => $quiz,
            'questionDetails' => $quiz->questionDetails
        ]);
    }

    function detailCreate($id) {
        return view('pages.quiz.detail-create', [
            'quiz' => Question::query()->withCount('questionDetails')->where('id', $id)->first()
        ]);
    }

    function detailStore($id, Request $request) {
        $request->validate([
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'e' => 'required',
            'correct_answer' => 'required',
        ]);

        $quiz = Question::query()->withCount('questionDetails')->where('id', $id)->first();

        $quiz->questionDetails()->create([
            'photo' => $request->hasFile('photo') ? $request->file('photo')->store('pictures', 'public') : null,
            'question' => $request->question,
            'a' => $request->a,
            'b' => $request->b,
            'c' => $request->c,
            'd' => $request->d,
            'e' => $request->e,
            'correct_answer' => $request->correct_answer,
            'explain' => $request->hasFile('explain') ? $request->file('explain')->store('pictures', 'public') : null,
        ]);

        return redirect('/quizzes');
    }

    function myQuizzes() {
        return view('pages.quiz.my-page', [
            'quizzes' => Question::query()->withCount([
                'questionDetails', 
                'answers' => function ($q) {
                    $q->where('answers.user_id', Auth::user()->id);
                },
                'done' => function ($q) {
                    $q->where('question_dones.user_id', Auth::user()->id);
                }
            ])->get()
        ]);
    }

    function myDetailQuiz($id) {
        $is_done = false;
        $questionDone = QuestionDone::query()
                ->where('user_id', Auth::user()->id)
                ->where('question_id', $id)
                ->first();

        $select = [
            'id', 'question_id', 'question', 'photo',
            'a', 'b', 'c', 'd', 'e', 'explain'
        ];

        if ($questionDone) {
            $is_done = true;
            $select[] = 'correct_answer';
        }

        $questionDetail = QuestionDetail::query()->where('question_id', $id)->select($select)->paginate(1);

        if ($questionDetail->isEmpty()) {
            throw new Exception('Quiz not found');
        }

        $rawQuestionDetail = $questionDetail->items()[0];
        $answer = Answer::query()->where('user_id', Auth::user()->id)->where('question_detail_id', $rawQuestionDetail->id)->first();

        return view('quiz', [
            'question' => $questionDetail,
            'answer' => $answer,
            'is_done' => $is_done,
            'variant' => function($label) use($answer, $questionDetail) {
                $variant = 'netral';

                if (
                        $answer?->answer === $questionDetail->items()[0]->correct_answer &&
                        $answer?->answer === $label
                    ) {
                        return "correct";
                    }

                    if (
                        $answer?->answer !== $questionDetail->items()[0]->correct_answer &&
                        $questionDetail->items()[0]->correct_answer === $label
                    ) {
                        return "correct";
                    }

                    if (
                        $answer?->answer !== $questionDetail->items()[0]->correct_answer &&
                        $answer?->answer === $label
                    ) {
                        return "wrong";
                    }

                    return $variant;
                }
        ]);
    }

    function myDetailQuizStore($id, Request $request) {
        $request->validate([
            'question_detail_id' => 'required'
        ]);

        if ($request->answer === null) { return; }

        $answer = Answer::query()
            ->where('user_id', Auth::user()->id)
            ->where('question_detail_id', $request->question_detail_id)
            ->first();

        if ($answer) {
            $answer->update([
                'answer' => $request->answer
            ]);
        } else {
            Answer::create([
                'user_id' => Auth::user()->id,
                'question_detail_id' => $request->question_detail_id,
                'answer' => $request->answer
            ]);
        }
    }

    function myDetailQuizDone($id, Request $request) {
        if (!QuestionDone::query()->where('user_id', Auth::user()->id)->where('question_id', $id)->first()) {
            QuestionDone::create([
                'user_id' => Auth::user()->id,
                'question_id' => $id
            ]);
        }

        return redirect("my-quizzes/$id/score");
    }

    function myDetailQuizScore($id, Request $request) {
        $question = Question::query()->with([
            'questionDetails.answer' => function ($q) {
                $q->where('answers.user_id', Auth::user()->id);
            },
        ])->where('id', $id)->firstOrFail();
        $correctCount = 0;

        foreach ($question->questionDetails as $questionDetail) {
            if ($questionDetail->answer && $questionDetail->correct_answer === $questionDetail->answer->answer) {
                $correctCount++;
            }
        }

        return view('Score', [
            'question' => $question,
            'correctCount' => $correctCount,
            'wrongCount' => $question->questionDetails->count() - $correctCount,
            'score' => floor(($correctCount / $question->questionDetails->count()) * 100)
        ]);
    }
}
