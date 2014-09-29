<?php

/**
 * 
 */

namespace RtTranslation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Form\Form;

use RtTranslation\Service\TranslationService;
use RtTranslation\Entity\Locale;
use RtTranslation\Entity\Key;

class TranslationController extends AbstractActionController
{
    /**
     * Locale form
     * @var \RtTranslation\Form\LocaleForm 
     */
    protected $localeForm;

    /**
     * Key form
     * @var \RtTranslation\Form\KeyForm  
     */
    protected $keyForm;
    
    /**
     * Translation form
     * @var \RtTranslation\Form\TranslationForm  
     */
    protected $translationForm;
    
    /**
     * Translation service
     * @var \RtTranslation\Service\TranslationService 
     */
    protected $translationService;

    /**
     * Action to change the locale
     * @return \Zend\View\Model\ViewModel 
     */
    public function changelocaleAction(){
        
        // disable layout
        $result = new ViewModel();
        $result->setTerminal(true);
    
        // variables
        $event   = $this->getEvent(); 
        $matches = $event->getRouteMatch(); 
        $myLocale = $matches->getParam('locale');
        $redirect = $matches->getParam('redirect', '');
        
        // translate
        $sessionContainer = new Container('locale');
        
        if(!in_array($myLocale, $this->getTranslationService()->getLocales(false))){
            $myLocale = 'en_US';
        }
        
        $sessionContainer->offsetSet('mylocale', $myLocale);
        
        // redirect
        switch ($redirect){
            case '':
                $this->redirect()->toRoute('home');
                break;
            default :
                $this->redirect()->toUrl(urldecode($redirect));
        }
        
        return $result;
    }
    
    
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction(){
        $viewmodel = new ViewModel();
        return $viewmodel;
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function localeAction(){
        $viewmodel = new ViewModel();
        $paginator = $this->getTranslationService()->getLocales(true);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $viewmodel->setVariable("paginator", $paginator);
        return $viewmodel;
    }

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function addlocaleAction(){
        
        $viewmodel  = new ViewModel();
        $request    = $this->getRequest();
        $form       = $this->getLocaleForm();
        $service    = $this->getTranslationService();
        
        if($request->isPost()) {
            $form->bind(new Locale());
            $form->setData($request->getPost());
            if($form->isValid()) {
                $service->addLocale($form->getData());
            }
        }
        
        $viewmodel->setVariable("form", $form);
        
        return $viewmodel;
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function editlocaleAction(){
        $viewmodel  = new ViewModel();
        $request    = $this->getRequest();
        $form       = $this->getLocaleForm();
        $service    = $this->getTranslationService();
        $localeId   = $this->params("localeId");
        
        if($request->isPost()) {
            $form->bind(new Locale());
            $form->setData($request->getPost());
            if($form->isValid()) {
                $service->editLocale($form->getData());
                $form->bind($form->getData());
            }
        }else{
            $form->bind($service->getLocale($localeId));
        }
        $viewmodel->setVariable("form", $form);
        
        return $viewmodel;
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function keyAction(){
        $viewmodel = new ViewModel();
        $paginator = $this->getTranslationService()->getKeys(true);
        $paginator->setDefaultItemCountPerPage(10);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $viewmodel->setVariable("paginator", $paginator);
        return $viewmodel;
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function addkeyAction(){
        $viewmodel = new ViewModel();
        return $viewmodel;
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function editkeyAction(){
        $viewmodel  = new ViewModel();
        $request    = $this->getRequest();
        $form       = $this->getKeyForm();
        $service    = $this->getTranslationService();
        $keyId   = $this->params("keyId");
        
        if($request->isPost()) {
            $form->bind(new Key());
            $form->setData($request->getPost());
            if($form->isValid()) {
                $service->editKey($form->getData());
                $form->bind($form->getData());
            }
        }else{
            $form->bind($service->getKey($keyId));
        }
        $viewmodel->setVariable("form", $form);
        
        return $viewmodel;
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function addtranslationAction(){
        
        $viewmodel  = new ViewModel();
        $request    = $this->getRequest();
        $form       = $this->getTranslationForm();
        $service    = $this->getTranslationService();
        
        if($request->isPost()) {
            $form->bind(new Translation());
            $form->setData($request->getPost());
            if($form->isValid()) {
                $service->addTranslation($form->getData());
            }else{
                var_dump($form->getData());
            }
        }
        
        $viewmodel->setVariable("form", $form);
        
        return $viewmodel;
    }
    
    public function translationAction(){
        $viewmodel = new ViewModel();
        $paginator = $this->getTranslationService()->getTranslations(true);
        $paginator->setDefaultItemCountPerPage(2);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        $viewmodel->setVariable("paginator", $paginator);
        return $viewmodel;
    }


    /**
     * 
     * @param \Zend\Form\Form $localeForm
     * @return \RtTranslation\Controller\TranslationController
     */
    public function setLocaleForm(Form $localeForm){
        $this->localeForm = $localeForm;
        return $this;
    }
    
    public function getLocaleForm(){
        if(!$this->localeForm){
            $this->setLocaleForm($this->getServiceLocator()->get("rt_translation_locale_form"));
        }
        return $this->localeForm;
    }
    
    public function setKeyForm(Form $keyForm){
        $this->keyForm = $keyForm;
        return $this;
    }
    
    public function getKeyForm(){
        if(!$this->keyForm){
            $this->setKeyForm($this->getServiceLocator()->get("rt_translation_key_form"));
        }
        return $this->keyForm;
    }
    
    /**
     * 
     * @param \Zend\Form\Form $translationForm
     * @return \RtTranslation\Controller\TranslationController
     */
    public function setTranslationForm(Form $translationForm){
        $this->translationForm = $translationForm;
        return $this;
    }
    
    /**
     * 
     * @return type
     */
    public function getTranslationForm(){
        if(!$this->translationForm){
            $this->setTranslationForm($this->getServiceLocator()->get("rt_translation_translation_form"));
        }
        return $this->translationForm;
    }
    
    /**
     * 
     * @param \RtTranslation\Service\TranslationService $translationService
     * @return \RtTranslation\Controller\TranslationController
     */
    public function setTranslationService(TranslationService $translationService){
        $this->translationService = $translationService;
        return $this;
    }
    
    /**
     * 
     * @return \RtTranslation\Service\TranslationService
     */
    public function getTranslationService(){
        if(!$this->translationService) {
            $this->translationService = $this->getServiceLocator()->get('rt_translation_translation_service');
        }
        return $this->translationService;
    }
}
