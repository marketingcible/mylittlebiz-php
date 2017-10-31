<?php
namespace MyLittleBiz\Rest;

use MyLittleBiz\Client;
/**
 * SmsAlerting
 */
class ContactGroup
{

    protected $Client;

    public function __construct(Client $Client)
    {
        $this->Client = $Client;
    }


    /**
     * List your groups
     *
     * @return {json}
     */
    public function fetch()
    {
        return $this->Client->request('GET', 'groups');
    }

    /**
     * List your groups
     * To list all template groups, you must specify their type.
     *
     * @param  {int} $contacts_group_id Contacts group identifier
     * @return {json}
     */
    public function search($contacts_group_id)
    {
        return $this->Client->request('GET', "groups/{$contacts_group_id}");
    }

    public function getByName($name)
    {
        foreach ($this->fetch()['data'] as $group) {
            if (strcmp($group['name'], $name) === 0) {
                return $this->search($group['id']);
            }
        }

        return false;
    }

    /**
     * Create a Group
     * To create a group of templates, you must specify a type and assign a name.
     *
     * @param  {string} $name               Group name
     * @param  {string} [$description=null] Group description
     * @return {json}
     */
    public function create($name, $description = null)
    {
        return $this->Client->request('POST', 'groups', [], ['name' => $name, 'description' => $description]);
    }

    /**
     * Modify a group
     * To modify a template group, you must specify its ID and assign a new name.
     *
     * @param  {int}    $id                 Contacts group identifier
     * @param  {string} $name               Group name
     * @param  {string} [$description=null] Group description
     * @return {json}
     */
    public function modify($id, $name, $description = null)
    {
        return $this->Client->request('PUT', 'groups/{$id}', [], ['name' => $name, 'description' => $description]);
    }

    /**
     * Delete a group
     *
     * @param  {int} $id Contacts group identifier
     * @return {json}
     */
    public function delete($id)
    {
        return $this->Client->request('DELETE', 'groups/{$id}');
    }
}
