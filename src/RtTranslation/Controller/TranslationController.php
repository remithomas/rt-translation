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

class TranslationController extends AbstractActionController
{
    
    protected $localeForm;

    protected $keyForm;
    
    protected $translationForm;
    
    /**
     *
     * @var \RtTranslation\Service\TranslationService 
     */
    protected $translationService;

    /**
     *
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
        
        switch ($myLocale){
            case 'fr_FR':
                break;
            case 'en_US':
                break;
            default :
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
        $locales = $this->getTranslationService()->getLocales();
        $viewmodel->setVariable("locales", $locales);
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
            }else{
                var_dump($form->getData());
            }
        }
        
        $viewmodel->setVariable("form", $form);
        
        return $viewmodel;
    }
    
    public function editlocaleAction(){
        $viewmodel = new ViewModel();
        return $viewmodel;
    }
    
    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function keyAction(){
        $viewmodel = new ViewModel();
        
        $paginator = $this->getTranslationService()->getKeys(true);
        // set the current page to what has been passed in query string, or to 1 if none set
        $paginator->setCurrentPageNumber((int)$this->params()->fromQuery('page', 1));
        // set the number of items per page to 10
        $paginator->setItemCountPerPage(10);
        
        $viewmodel->setVariable("paginator", $paginator);
        return $viewmodel;
    }
    
    public function addkeyAction(){
        $viewmodel = new ViewModel();
        return $viewmodel;
    }
    
    public function addtranslationAction(){
        $viewmodel = new ViewModel();
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
            $this->setLocaleForm($this->getServiceLocator()->get("rt_translation_key_form"));
        }
        return $this->keyForm;
    }
    
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
            $this->setLocaleForm($this->getServiceLocator()->get("rt_translation_translation_form"));
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
