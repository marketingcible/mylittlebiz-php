<?php
namespace MyLittleBiz\Rest;

use MyLittleBiz\Client;
/**
 * TemplateGroup
 */
class TemplateGroup
{

    protected $Client;

    public function __construct(Client $Client)
    {
        $this->Client = $Client;
    }

    /**
     * List your groups
     * To list all template groups, you must specify their type.
     * 
     * @param {string} $type    Group type templates (email or sms)
     * @return {json}
     */
    public function fetch($type)
    {
        return $this->Client->request('GET', 'objectifs/{$type}');
    }

    /**
     * Search a group
     * This API will help you search a template group. You must specify the group id.
     * 
     * Note: if your Brand has an option of default template you can find the attribute default_model_id.
     *
     * @param  {int}  $id   The template group identifier
     * @return {json}
     */
    public function search($id)
    {
        return $this->Client->request('GET', 'objectifs/{$id}');
    }

    /**
     * Create a group
     * To create a group of templates, you must specify a type and assign a name.
     *
     * @param  {string}  $type   Group type templates (email or sms)
     * @param  {string}  $name   Name of the group
     * @return {json}
     */
    public function create($type, $name)
    {
        return $this->Client->request('POST', 'objectifs/{$type}', [], [
                $name => $name,
            ]);
    }

    /**
     * Modify a group
     * To modify a template group, you must specify its id and assign a new name.
     *
     * @param  {id}      $id      The template group identifier
     * @param  {string}  $name    The new name of the group
     * @return {json}
     */
    public function modify($id, $name)
    {
        return $this->Client->request('PUT', 'objectifs/{$id}', [], [
                $name => $name,
            ]);
    }

    /**
     * Delete a group
     * To delete a template group you must specify its id.
     *
     * @param  {int} $id The template group identifier
     * @return {json}
     */
    public function delete($id)
    {
        return $this->Client->request('DELETE', 'objectifs/{$id}');
    }
}
