<?php namespace ProcessWire;

class InputfieldSimpleMDEConfig extends ModuleConfig
{

    public function getDefaults()
    {

        return [
            'monospaced' => true,
            'customConfig' => file_get_contents(dirname(__FILE__) . '/defaults.json')
        ];
    }

    public function getInputfields()
    {
        $defaults = $this->getDefaults();
        $fields = new InputfieldWrapper();

        /* @var $customJson InputfieldCheckbox */
        $mono = $this->modules->get('InputfieldCheckbox');
        $mono->name = 'useMonospacedFont';
        $mono->label = 'Use monospaced font';
        $mono->description = 'Untick if you want to use default font';
        $mono->attr('checked', empty($this->monospaced) ? $defaults['monospaced'] : $this->monospaced);
        $fields->add($mono);

        /* @var $customJson InputfieldTextarea */
        $customJson = $this->modules->get('InputfieldTextarea');
        $customJson->name = 'customConfig';
        $customJson->label = 'Custom Configuration';
        $customJson->description = 'Specify custom configuration in JSON format. See [SimpleMDE page](https://github.com/NextStepWebs/simplemde-markdown-editor#configuration) for details';
        $customJson->attr('value', empty($this->customConfig) ? $defaults['customConfig'] : $this->customConfig);
        $customJson->attr('rows', 10);

        bd(empty($this->customConfig));

        $fields->add($customJson);

        return $fields;
    }
}