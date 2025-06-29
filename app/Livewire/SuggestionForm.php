<?php

namespace App\Livewire;

use App\Models\Suggestion;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SuggestionForm extends Component
{
    public $feedback_type = '';
    public $rating = 5;
    public $subject = '';
    public $feedback_message = '';
    public $specific_area = '';
    public $priority = 'medium';
    public $name = '';
    public $email = '';
    public $ease_of_use = 5;
    public $performance = 5;
    public $design = 5;
    public $would_recommend = true;
    public $additional_features = '';

    protected $rules = [
        'feedback_type' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
        'subject' => 'required|string|min:5|max:100',
        'feedback_message' => 'required|string|min:10|max:1000',
        'specific_area' => 'required|string',
        'priority' => 'required|in:low,medium,high',
        'name' => 'nullable|string|max:50',
        'email' => 'nullable|email|max:100',
        'ease_of_use' => 'required|integer|min:1|max:5',
        'performance' => 'required|integer|min:1|max:5',
        'design' => 'required|integer|min:1|max:5',
        'would_recommend' => 'required|boolean',
        'additional_features' => 'nullable|string|max:500'
    ];

    protected $messages = [
        'feedback_type.required' => 'Silakan pilih jenis feedback.',
        'rating.required' => 'Rating kepuasan wajib diisi.',
        'subject.required' => 'Subjek saran wajib diisi.',
        'subject.min' => 'Subjek minimal 5 karakter.',
        'feedback_message.required' => 'Pesan saran wajib diisi.',
        'feedback_message.min' => 'Pesan minimal 10 karakter.',
        'specific_area.required' => 'Silakan pilih area spesifik.',
        'email.email' => 'Format email tidak valid.',
    ];

    public function mount()
    {
        if (auth()->check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    public function submitSuggestion()
    {
        $this->validate();

        try {
            // Prepare data for database
            $suggestionData = [
                'user_id' => auth()->id(),
                'feedback_type' => $this->feedback_type,
                'rating' => $this->rating,
                'subject' => $this->subject,
                'feedback_message' => $this->feedback_message,
                'specific_area' => $this->specific_area,
                'priority' => $this->priority,
                'name' => $this->name ?: (auth()->check() ? auth()->user()->name : null),
                'email' => $this->email ?: (auth()->check() ? auth()->user()->email : null),
                'ease_of_use' => $this->ease_of_use,
                'performance' => $this->performance,
                'design' => $this->design,
                'would_recommend' => $this->would_recommend,
                'additional_features' => $this->additional_features,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'status' => 'pending'
            ];

            // Save to database
            $suggestion = Suggestion::create($suggestionData);

            // Log the suggestion for admin tracking
            Log::info('New suggestion submitted', [
                'suggestion_id' => $suggestion->id,
                'user_id' => auth()->id(),
                'feedback_type' => $this->feedback_type,
                'priority' => $this->priority
            ]);

            // Optional: Send notification email to admin
            // if (config('mail.admin_notifications', false)) {
            //     Mail::to(config('mail.admin_email'))->send(new NewSuggestionMail($suggestion));
            // }

            // Success message
            Toaster::success('Terima kasih! Saran Anda telah berhasil dikirim dan akan kami review.');

            // Reset form
            $this->resetForm();

        } catch (\Exception $e) {
            Log::error('Failed to submit suggestion', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            Toaster::error('Maaf, terjadi kesalahan saat mengirim saran. Silakan coba lagi.');
        }
    }

    private function resetForm()
    {
        $this->reset([
            'feedback_type',
            'subject',
            'feedback_message',
            'specific_area',
            'priority',
            'additional_features'
        ]);

        // Reset ratings to default values
        $this->rating = 5;
        $this->ease_of_use = 5;
        $this->performance = 5;
        $this->design = 5;
        $this->would_recommend = true;

        // Keep user info if logged in
        if (!auth()->check()) {
            $this->reset(['name', 'email']);
        }
    }

    public function render()
    {
        return view('livewire.user.suggestion-form');
    }
}
