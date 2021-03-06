<?php
/**
 * Group Deal
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    GroupDeal
 * @subpackage Core
 * @author     Agriya <info@agriya.com>
 * @copyright  2018 Agriya Infoway Private Ltd
 * @license    http://www.agriya.com/ Agriya Infoway Licence
 * @link       http://www.agriya.com
 */
class UserIncomeRangesController extends AppController
{
    public $name = 'UserIncomeRanges';
    public function admin_index()
    {
        $this->pageTitle = __l('Income Ranges');
        $this->UserIncomeRange->recursive = 0;
        $this->set('userIncomeRanges', $this->paginate());
        $this->set('pageTitle', $this->pageTitle);
    }
    public function admin_add()
    {
        $this->pageTitle = __l('Add Income Range');
        $this->UserIncomeRange->create();
        if (!empty($this->request->data)) {
            if ($this->UserIncomeRange->save($this->request->data)) {
                $this->Session->setFlash(__l('Income Range has been added') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Income Range could not be added. Please, try again.') , 'default', null, 'error');
            }
        }
        $this->set('pageTitle', $this->pageTitle);
    }
    public function admin_edit($id = null)
    {
        $this->pageTitle = __l('Edit Income Range');
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if (!empty($this->request->data)) {
            if ($this->UserIncomeRange->save($this->request->data)) {
                $this->Session->setFlash(__l('Income Range has been updated') , 'default', null, 'success');
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__l('Income Range could not be updated. Please, try again.') , 'default', null, 'error');
            }
        } else {
            $this->request->data = $this->UserIncomeRange->read(null, $id);
            if (empty($this->request->data)) {
                throw new NotFoundException(__l('Invalid request'));
            }
        }
        $this->set('pageTitle', $this->pageTitle);
    }
    public function admin_delete($id = null)
    {
        if (is_null($id)) {
            throw new NotFoundException(__l('Invalid request'));
        }
        if ($this->UserIncomeRange->delete($id)) {
            $this->Session->setFlash(__l('Income Range deleted') , 'default', null, 'success');
            $this->redirect(array(
                'action' => 'index'
            ));
        } else {
            throw new NotFoundException(__l('Invalid request'));
        }
    }
}
?>