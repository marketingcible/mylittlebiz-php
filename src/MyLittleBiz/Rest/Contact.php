<?php
namespace MyLittleBiz\Rest;

use \MyLittleBiz\Client;
/**
 * Contact
 */
class Contact
{

    protected $Client;

    public function __construct(Client $Client)
    {
        $this->Client = $Client;
    }

    /**
     * List the contacts of a group
     * In order to list all the contact of a group, you must specify the id group
     * The query limit is 10 000 contacts
     *
     * @param  {int} $groupId     Contacts group identifier
     * @param  {int} [$from=null] Number of contacts to skip
     * @return {json}
     */
    public function fetch($groupId, $from = 0, $fullData = true)
    {
        $params = (!empty($from)) ? ['from' => (int) $from] : [];

        $contacts = $this->Client->request('GET', "groups/{$groupId}/contacts", $params);

        if (!$fullData) {
            foreach ($contacts['data'] as $kc => $contact) {
                $contacts['data'][$kc] = array_intersect_key($contact, array_flip(['id_user', 'fnamn', 'enamn', 'salutation', 'epost', 'mob', 'state']));
            }
        }

        return $contacts;
    }

    /**
     * Récupère tous les contacts de tous les groupes
     */
    public function listAll($fullData = true)
    {
        $contacts = [];

        $groups = $this->Client->ContactGroup()->fetch();

        foreach ($groups['data'] as $group) {
            foreach ($this->fetch($group['id'], 0, $fullData)['data'] as $contact) {
                $contact['group'] = $group;
                $contacts[] = $contact;
            }
        }

        return $contacts;
    }

    /**
     * Search a contact
     * In order to search a contact, you must specify its id
     *
     * @param  {int} int Contact identifier
     * @return {json}
     */
    public function search($id)
    {
        return $this->Client->request('GET', "contacts/{$id}");
    }

    /**
     * Create a contact
     * In order to create a contact, you must specify the Group id.
     *
     * @param  {int} $groupId   Group Id
     * @param  {Array}  $data   Contact infos
     * data parameters :
     * - mobile	       Required	Contact mobile (Not required if email parameter exists)
     * - email	       Required	Contact email (Not required if mobile parameter exists)
     * - civility	     Optional	Contact civility
     * - fname	       Optional	Contact first name
     * - lname	       Optional	Contact last name
     * - birthday	     Optional	Contact birthday
     * - ind	         Optional	Mobile country code. Ex.: FR|MA|..
     * - is_blacklist	 Optional	Blacklist this contact ? 0|1
     * - updated_field Optional	Update data by : mob|email
     * @return {json}
     */
    public function create($groupId, array $data)
    {
        return $this->Client->request('POST', "groups/{$groupId}/contacts", [], $data);
    }

    /**
     * Modify a contact
     * In order to modify a contact, you must specify its id.
     *
     * @param  {int} $id        Contact identifier
     * @param  {Array}  $data   Contact infos
     * data parameters :
     * - mobile	       Required	Contact mobile (Not required if email parameter exists)
     * - email	       Required	Contact email (Not required if mobile parameter exists)
     * - civility	     Optional	Contact civility
     * - fname	       Optional	Contact first name
     * - lname	       Optional	Contact last name
     * - birthday	     Optional	Contact birthday
     * - ind	         Optional	Mobile country code. Ex.: FR|MA|..
     * @return {json}
     */
    public function modify($id, array $data = [])
    {
        return $this->Client->request('PUT', "contacts/{$id}", $data);
    }

    /**
     * Delete a contact
     * In order to delete a contact, you must specify its id.
     *
     * @param  {int} $id Contact identifier
     * @return {json}
     */
    public function delete($id)
    {
        return $this->Client->request('DELETE', "contacts/{$id}");
    }
}
