<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Doctrine\ORM\EntityManager;
use Application\Entity\Contact;
use Application\Entity\Address;
use Application\Form\ContactForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * ImportController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $contactRepository = $this->entityManager->getRepository(Contact::class);
        $contacts = $contactRepository->findAll();
        return new ViewModel([
            'contacts' => $contacts
        ]);
    }
    public function viewAction()
    {
        $contactRepository = $this->entityManager->getRepository(Contact::class);
        $id = $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        $qb = $contactRepository->createQueryBuilder('contact');
        $qb->where('contact = :contact')
            ->setParameter('contact', $id);
        /** @var Contact $contact */
        $contact = $qb->getQuery()->getOneOrNullResult();
        $attrs = [];
        $attrs[] = 'Nome: ' . $contact->getName();
        $attrs[] = 'Email: ' . $contact->getEmail();
        $attrs[] = 'Celular: ' . $contact->getPhone();
        $attrs[] = 'Descrição: ' . $contact->getDescr();
        $attrs[] = 'Rua: ' . $contact->getAddress()->getStreet();
        $attrs[] = 'Numero: ' . $contact->getAddress()->getNumber();
        $attrs[] = 'Bairro: ' . $contact->getAddress()->getDistrict();
        $attrs[] = 'Cidade: ' . $contact->getAddress()->getCity();
          
        return new ViewModel(["attrs"=>$attrs]);
    }
    public function addAction()
    {
        $form = new ContactForm($this->entityManager);
        $form->setAttribute('action', $this->url()->fromRoute('contact', ['action' => 'add']));

        $request = $this->getRequest();

        $contact = new Contact();
        $form->bind($contact);
        $isValid = true;
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData($form::VALUES_AS_ARRAY);
                $address = new Address();
                $address->setStreet($data["street"]);
                $address->setNumber($data["number"]);
                $address->setDistrict($data["district"]);
                $address->setCity($data["city"]);
                $now = new \DateTime();
                $contact->setCreatedAt($now);
                $contact->setUpdatedAt($now);
                $contact->setAddress($address);
                // $this->entityManager->persist($address);
                $this->entityManager->persist($contact);
                $this->entityManager->flush();
                return $this->redirect()->toRoute('contact');
            }
        }
         
        return new ViewModel(["form"=>$form]);
    }
    public function editAction()
    {
        $contactRepository = $this->entityManager->getRepository(Contact::class);
        $id = $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        $qb = $contactRepository->createQueryBuilder('contact');
        $qb->where('contact = :contact')
            ->setParameter('contact', $id);
        /** @var Contact $contact */
        $contact = $qb->getQuery()->getOneOrNullResult();

        if ($contact === null) {
            $this->flashMessenger()->addErrorMessage(_('Contato não encontrado.'));
            return $this->redirect()->toRoute('contact');
        }

        $form = new ContactForm($this->entityManager);
        $form->setAttribute('action', $this->url()->fromRoute('contact', ['action' => 'edit', 'id' => $id]));

        $request = $this->getRequest();

        // $contact = new Contact();
        $form->bind($contact);
        $isValid = true;
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData($form::VALUES_AS_ARRAY);
                // $address = new Address();
                $contact->getAddress()->setStreet($data["street"]);
                $contact->getAddress()->setNumber($data["number"]);
                $contact->getAddress()->setDistrict($data["district"]);
                $contact->getAddress()->setCity($data["city"]);
                $now = new \DateTime();
                $contact->setCreatedAt($now);
                $contact->setUpdatedAt($now);
                // $contact->setAddress($address);
                $this->entityManager->persist($contact);
                $this->entityManager->flush();
                return $this->redirect()->toRoute('contact');
            }
        } else {
            $form->get('street')->setValue($contact->getAddress()->getStreet());
            $form->get('number')->setValue($contact->getAddress()->getNumber());
            $form->get('district')->setValue($contact->getAddress()->getDistrict());
            $form->get('city')->setValue($contact->getAddress()->getCity());
        }
         
        return new ViewModel(["form"=>$form]);
    }
    public function deleteAction()
    {
        $contactRepository = $this->entityManager->getRepository(Contact::class);
        $id = $this->params()->fromRoute('id', 0);

        $qb = $contactRepository->createQueryBuilder('contact');
        $qb->where('contact = :contact')
            ->setParameter('contact', $id);
        /** @var Contact $contact */
        $contact = $qb->getQuery()->getOneOrNullResult();
        if ($contact === null) {
            // $this->flashMessenger()->addErrorMessage(_('Contact não encontrado.'));
            return $this->redirect()->toRoute('contact');
        }

        $request = $this->getRequest();
        if ($request->isDelete() || $request->isPost()) {
            $this->entityManager->remove($contact);
            $this->entityManager->flush();
            // $this->flashMessenger()->addSuccessMessage(_('Contact excluído com sucesso!'));
            return $this->redirect()->toRoute('contact');
        } else {
            $viewModel = new ViewModel([
                'contact' => $contact
            ]);

            return $viewModel;
        }
    }
}
