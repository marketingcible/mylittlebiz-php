<?php
namespace MyLittleBiz\Rest;

use MyLittleBiz\Client;
/**
 * SmsAlerting
 */
class Template
{

    protected $Client;

    public function __construct(Client $Client)
    {
        $this->Client = $Client;
    }


    /**
     * List all your Templates
     * To list all your templates, you must specify the group ID.
     *
     * @param  {int} $objectifId    The template group identifier
     * @return {json}
     */
    public function fetch($objectifId)
    {
        return $this->Client->request('GET', 'objectifs/{$objectifId}/models');
    }

    /**
     * Search a template
     * In order to search a template, you must specify its id
     * Note: if your Brand has an option of default template you can find the attribute default (true/false).
     *
     * @param  {int} int Template identifier
     * @return {json}
     */
    public function search($id)
    {
        return $this->Client->request('GET', 'models/{$id}');
    }

    /**
     * Create an SMS template
     * To create a template, you must specify the group id, the “subject” field,
     * the “from” field (name), the “sender” field (email address) and the content.
     *
     * @param  {int}  $objectifId          The template group identifier
     * @param  {string}  $title            The template name
     * @param  {string}  $sender           The sender
     * @param  {string}  $content          The template content
     * @param  {Boolean} [$editable=false] Is template editable
     * @return {json}
     */
    public function createSms($objectifId, $title, $sender, $content, $editable = false)
    {
        return $this->Client->request('POST', 'objectifs/{$objectifId}/models', [], [
                $title => $title,
                $sender => $sender,
                $content => $content,
                $editable => $editable
            ]);
    }

    /**
     * Create an EMAIL template
     * To create a template, you must specify the group id, the “subject” field,
     * the “from” field (name), the “sender” field (email address) and the content.
     *
     * @param  {int}     $objectifId   The template group identifier
     * @param  {string}  $subject      The template subject
     * @param  {string}  $from         The sender name
     * @param  {string}  $sender       The sender address
     * @param  {string}  $content      The template content
     * @param  {string}  $analytic     Google analytic code
     * @return {json}
     */
    public function createEmail($objectifId, $subject, $from, $sender, $content, $analytic = null)
    {
        return $this->Client->request('POST', 'objectifs/{$objectifId}/models', [], [
                $subject => $subject,
                $from => $from,
                $sender => $sender,
                $content => $content,
                $analytic => $analytic
            ]);
    }

    /**
     * Modify an SMS template
     * To modify a template, you must pick at least one field.
     *
     * @param  {int}     $id               The template identifier
     * @param  {string}  $title            The template name
     * @param  {string}  $sender           The sender
     * @param  {string}  $content          The template content
     * @param  {Boolean} [$editable=false] Is template editable
     * @return {json}
     */
    public function modifySms($id, $title, $sender, $content, $editable = false)
    {
        return $this->Client->request('PUT', 'models/{$id}/models', [], [
                $title => $title,
                $sender => $sender,
                $content => $content,
                $editable => $editable
            ]);
    }

    /**
     * Modify an EMAIL template
     * To modify a template, you must pick at least one field.
     *
     * @param  {int}     $objectifId   The template group identifier
     * @param  {string}  $subject      The template subject
     * @param  {string}  $from         The sender name
     * @param  {string}  $sender       The sender address
     * @param  {string}  $content      The template content
     * @param  {string}  $analytic     Google analytic code
     * @return {json}
     */
    public function modifyEmail($objectifId, $subject, $from, $sender, $content, $analytic = null)
    {
        return $this->Client->request('PUT', 'models/{$id}/models', [], [
                $subject => $subject,
                $from => $from,
                $sender => $sender,
                $content => $content,
                $analytic => $analytic
            ]);
    }

    /**
     * Delete a template
     * To delete a template, you must specify its id
     *
     * @param  {int} $id The template identifier
     * @return {json}
     */
    public function delete($id)
    {
        return $this->Client->request('DELETE', 'models/{$id}');
    }
}
