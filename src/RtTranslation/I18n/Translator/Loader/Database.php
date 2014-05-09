<?php

namespace RtTranslation\I18n\Translator\Loader;

use Zend\I18n\Exception,
    Zend\I18n\Translator\TextDomain,
    Zend\I18n\Translator\Loader\RemoteLoaderInterface;

use Zend\Db\Adapter\Adapter,
    Zend\Db\Sql\Sql,
    Zend\Db\Sql\Where;

class Database implements RemoteLoaderInterface
{

    /**
     * Database adapter.
     * @var \Zend\Db\Adapter\Adapter
     */
    protected $dbAdapter;
    
    /**
     * 
     * @param \Zend\Db\Adapter\Adapter $dbAdapter
     */
    public function __construct(Adapter $dbAdapter) {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * 
     * @param string $locale
     * @param string $textDomain
     * @return \Zend\I18n\Translator\TextDomain
     */
    public function load($locale, $textDomain) {
        //var_dump($textDomain);die;
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select();
        $select ->from('translation_locale')
                ->columns(array('locale_plural_forms'))
                ->where(array(
                    'locale_locale' => $locale,
                    'locale_published' => 1
                ));
        
        $localeInformation = $this->dbAdapter->query(
            $sql->getSqlStringForSqlObject($select),
                \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE
        );

        if ($localeInformation->count() == 0) {
            return $textDomain;
        }
        //return $textDomain;
        $textDomain = new TextDomain();
        $aLocaleInformation = $localeInformation->current();
        //\Zend\Debug\Debug::dump($aLocaleInformation['locale_plural_rule']);die("pr");
        $textDomain->setPluralRule(
            \Zend\I18n\Translator\Plural\Rule::fromString($aLocaleInformation['locale_plural_forms'])
        );
        
        
        $select = $sql->select();
        $select ->from('translation_translation')
                ->columns(array('translation_locale','translation_translation','translation_plural_index'))
                ->join("translation_key", 'translation_key.key_id = translation_translation.translation_key_id', array('key_message'))
                ->where(array(
                    'translation_translation.translation_locale' => $locale,
                    'translation_translation.translation_published' => 1,
                ))
                ->order(array('translation_translation.translation_translation ASC','translation_translation.translation_plural_index ASC'));
        
        $messages = $this->dbAdapter->query(
            $sql->getSqlStringForSqlObject($select),
            Adapter::QUERY_MODE_EXECUTE
        );
        
        foreach ($messages as $message) {
            
            if (isset($textDomain[$message['key_message']])) {
                if (!is_array($textDomain[$message['key_message']])) {
                    $textDomain[$message['key_message']] = array(
                        '0' => $textDomain[$message['key_message']]
                        //$message['translation_plural_index'] => $textDomain[$message['key_message']]
                    );
                }
                $textDomain[$message['key_message']][$message['translation_plural_index']] = $message['translation_translation'];
            }else{
                $textDomain[$message['key_message']] = $message['translation_translation'];
            }
            
        }
        //echo "<textarea>" . $sql->getSqlStringForSqlObject($select) . "</textarea>";
        //\Zend\Debug\Debug::dump($textDomain);die;
        return $textDomain;
    }
}