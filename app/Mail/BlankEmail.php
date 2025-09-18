<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlankEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_subject;
    public $data;
    public $mail_bcc;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $data, $bccs = "")
    {
        $this->mail_subject = $subject;
        $this->data = $data;
        $this->mail_bcc = $bccs ? array_map('trim', explode(",", $bccs)) : [];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->view('mail.blank-mail')->from('finance-tncpi@utm.my', 'FINANCE TNCPI UTM')
            ->subject($this->mail_subject)
            ->with(['data' => $this->data]);
            
        if (!empty($this->data['filepaths'])) {
            foreach ($this->data['filepaths'] as $file) {
                if ($file && file_exists($file)) {
                    $mail->attach($file);
                }
            }
        }
        if (!empty($this->mail_bcc)) $mail->bcc($this->mail_bcc);
        return $mail;
    }}
