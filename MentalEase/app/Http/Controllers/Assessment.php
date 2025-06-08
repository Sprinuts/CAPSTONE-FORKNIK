<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Assessment extends Controller
{
    public function pss()
    {
        return view('include/header')
            .view('include/navbar')
            .view('assessment/pss');
    }

    public function pssassessment()
    {
        return view('include/header')
            .view('include/navbar')
            .view('assessment/pssassessment');
    }

    public function pssSubmit(Request $request)
    {
    //         {
    //     return view('include/header')
    //         .view('include/navbar')
    //         .view('assessment/pssSubmit');
    // }
        // Validate the form data
        $validatedData = $request->validate([
            'q1' => 'required|integer|between:0,4',
            'q2' => 'required|integer|between:0,4',
            'q3' => 'required|integer|between:0,4',
            'q4' => 'required|integer|between:0,4',
            'q5' => 'required|integer|between:0,4',
            'q6' => 'required|integer|between:0,4',
            'q7' => 'required|integer|between:0,4',
            'q8' => 'required|integer|between:0,4',
            'q9' => 'required|integer|between:0,4',
            'q10' => 'required|integer|between:0,4',
            
            // Add validation for all 10 questions
        ]);
        
        // Calculate the PSS score
        // Note: In the full PSS, questions 4, 5, 7, and 8 are positively stated
        // and need to be reverse-scored (4=0, 3=1, 2=2, 1=3, 0=4)
        $score = 0;
        foreach ($validatedData as $key => $value) {
            // Add logic for reverse scoring if needed
            $score += $value;
        }
        
        // Store the results in the database or session
        // This is a placeholder - you'll need to implement your own storage logic
        
        // Redirect to results page
        return redirect()->route('assessment.pss.results')->with('score', $score);
    }

    public function pssResults()
    {
        // Check if we have a score in the session
        if (!session()->has('score')) {
            return redirect()->route('assessment.pss');
        }
        
        $score = session('score');
        
        // Determine stress level based on score
        // PSS scores are obtained by reversing responses to the four positively stated items
        // and then summing across all scale items.
        // These are general guidelines:
        $stressLevel = '';
        $recommendations = [];
        
        if ($score <= 13) {
            $stressLevel = 'Low Stress';
            $recommendations = [
                'Continue your current stress management practices',
                'Regular exercise and healthy diet',
                'Maintain social connections',
                'Practice mindfulness occasionally'
            ];
        } elseif ($score <= 26) {
            $stressLevel = 'Moderate Stress';
            $recommendations = [
                'Incorporate regular relaxation techniques',
                'Consider time management strategies',
                'Ensure adequate sleep',
                'Limit caffeine and alcohol',
                'Regular physical activity'
            ];
        } else {
            $stressLevel = 'High Stress';
            $recommendations = [
                'Consider speaking with a mental health professional',
                'Practice daily stress reduction techniques',
                'Identify and address major stressors in your life',
                'Ensure work-life balance',
                'Prioritize self-care activities',
                'Join support groups or seek social support'
            ];
        }
        
        return view('assessment/pssresults', compact('score', 'stressLevel', 'recommendations'));
    }

    public function dass()
    {
        return view('include/header')
            .view('include/navbar')
            .view('assessment/dass');
    }

    public function dassassessment()
    {
        return view('include/header')
            .view('include/navbar')
            .view('assessment/dassassessment');
    }

    public function dassAssessmentTake()
    {
        return view('include/header')
            .view('include/navbar')
            .view('assessment/dassassessment');
    }

    public function dassSubmit(Request $request)
    {
        // Validate the request
        $request->validate([
            'q1' => 'required|integer|between:0,3',
            'q2' => 'required|integer|between:0,3',
            'q3' => 'required|integer|between:0,3',
            'q4' => 'required|integer|between:0,3',
            'q5' => 'required|integer|between:0,3',
            'q6' => 'required|integer|between:0,3',
            'q7' => 'required|integer|between:0,3',
            'q8' => 'required|integer|between:0,3',
            'q9' => 'required|integer|between:0,3',
            'q10' => 'required|integer|between:0,3',
            'q11' => 'required|integer|between:0,3',
            'q12' => 'required|integer|between:0,3',
            'q13' => 'required|integer|between:0,3',
            'q14' => 'required|integer|between:0,3',
            'q15' => 'required|integer|between:0,3',
            'q16' => 'required|integer|between:0,3',
            'q17' => 'required|integer|between:0,3',
            'q18' => 'required|integer|between:0,3',
            'q19' => 'required|integer|between:0,3',
            'q20' => 'required|integer|between:0,3',
            'q21' => 'required|integer|between:0,3',
        ]);
        
        // Calculate scores for each category
        // Depression: 3, 5, 10, 13, 16, 17, 21
        $depressionScore = $request->q3 + $request->q5 + $request->q10 + $request->q13 + 
                           $request->q16 + $request->q17 + $request->q21;
        
        // Anxiety: 2, 4, 7, 9, 15, 19, 20
        $anxietyScore = $request->q2 + $request->q4 + $request->q7 + $request->q9 + 
                        $request->q15 + $request->q19 + $request->q20;
        
        // Stress: 1, 6, 8, 11, 12, 14, 18
        $stressScore = $request->q1 + $request->q6 + $request->q8 + $request->q11 + 
                       $request->q12 + $request->q14 + $request->q18;
        
        // Multiply scores by 2 to get the equivalent of the DASS-42 score
        $depressionScore *= 2;
        $anxietyScore *= 2;
        $stressScore *= 2;
        
        // Store scores in session
        session([
            'depression_score' => $depressionScore,
            'anxiety_score' => $anxietyScore,
            'stress_score' => $stressScore
        ]);
        
        // Redirect to results page
        return redirect()->route('assessment.dass.results');
    }

    public function dassResults()
    {
        // Check if we have scores in the session
        if (!session()->has('depression_score') || 
            !session()->has('anxiety_score') || 
            !session()->has('stress_score')) {
            return redirect()->route('assessment.dass');
        }
        
        $depressionScore = session('depression_score');
        $anxietyScore = session('anxiety_score');
        $stressScore = session('stress_score');
        
        // Determine severity levels
        $depressionLevel = $this->getDassDepressionLevel($depressionScore);
        $anxietyLevel = $this->getDassAnxietyLevel($anxietyScore);
        $stressLevel = $this->getDassStressLevel($stressScore);
        
        // Get recommendations based on scores
        $recommendations = $this->getDassRecommendations($depressionLevel, $anxietyLevel, $stressLevel);
        
        return view('assessment/dassresults', compact(
            'depressionScore', 'anxietyScore', 'stressScore',
            'depressionLevel', 'anxietyLevel', 'stressLevel',
            'recommendations'
        ));
    }

    private function getDassDepressionLevel($score)
    {
        if ($score <= 9) {
            return 'Normal';
        } elseif ($score <= 13) {
            return 'Mild';
        } elseif ($score <= 20) {
            return 'Moderate';
        } elseif ($score <= 27) {
            return 'Severe';
        } else {
            return 'Extremely Severe';
        }
    }

    private function getDassAnxietyLevel($score)
    {
        if ($score <= 7) {
            return 'Normal';
        } elseif ($score <= 9) {
            return 'Mild';
        } elseif ($score <= 14) {
            return 'Moderate';
        } elseif ($score <= 19) {
            return 'Severe';
        } else {
            return 'Extremely Severe';
        }
    }

    private function getDassStressLevel($score)
    {
        if ($score <= 14) {
            return 'Normal';
        } elseif ($score <= 18) {
            return 'Mild';
        } elseif ($score <= 25) {
            return 'Moderate';
        } elseif ($score <= 33) {
            return 'Severe';
        } else {
            return 'Extremely Severe';
        }
    }

    private function getDassRecommendations($depressionLevel, $anxietyLevel, $stressLevel)
    {
        $recommendations = [];
        
        // Depression recommendations
        if ($depressionLevel == 'Normal') {
            $recommendations['depression'] = [
                'Continue your current mental wellness practices',
                'Maintain social connections and activities you enjoy',
                'Regular exercise and healthy diet'
            ];
        } elseif ($depressionLevel == 'Mild' || $depressionLevel == 'Moderate') {
            $recommendations['depression'] = [
                'Consider speaking with a mental health professional',
                'Practice mindfulness and relaxation techniques',
                'Establish a regular sleep schedule',
                'Engage in physical activity regularly',
                'Connect with supportive friends and family'
            ];
        } else {
            $recommendations['depression'] = [
                'Consult with a mental health professional as soon as possible',
                'Consider therapy options such as CBT (Cognitive Behavioral Therapy)',
                'Establish a daily routine with small, achievable goals',
                'Reach out to trusted friends or family for support',
                'Practice self-compassion and avoid self-criticism'
            ];
        }
        
        // Anxiety
    }
}



