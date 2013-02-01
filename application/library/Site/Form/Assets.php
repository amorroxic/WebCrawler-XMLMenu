<?php
	class Site_Form_Assets extends Zend_Form {

		public function init() {

			$this->setMethod('POST');

			// creating form element
			$assetURL= $this->createElement('text', 'siteurl');
			$assetURL->setLabel('URL:');
			$assetURL->setRequired(true);
			$assetURL->setOptions(array('filters'=>array('StringTrim','StripTags')));

			// adding my custom validator (url valid)
			$assetURL->addPrefixPath('Site_Validator','Site/Validator','validate');
			$assetURL->addValidator('URL', true);
			$assetURL->setDecorators(
				array(
					'ViewHelper',
					array('Label',array('class'=>'clearfix')),
					'Errors'
				)
			);

			$submit = $this->createElement('submit','submit',array('label' => 'Fetch documents from the website'));
			$submit->removeDecorator('DtDdWrapper');

			$this->addElement($assetURL);
			$this->addElement($submit);

		}

	}