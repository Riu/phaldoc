<?php namespace Phaldoc;

class Validation
{ 
    public $validation,$filter;

    public function __construct()
    {
        $this->validation = new \Phalcon\Validation();
    }

    public function render($post)
    {
        $this->validation->validate($post);
        $messages = array();
        $fields = array();
        foreach ($this->validation->getMessages() as $message) {
            $field = $message->getField();
            if(!in_array($field,$fields))
            {
                $messages[] = array(
                    'field' => $field,
                    'message' => $message->getMessage(),
                );
            }
            $fields[] = $field;
        }

        if(count($messages))
        {
            $success = 0;
        }
        else{
            $success = 1;
        }

        $data = array(
            'success' => $success, 
            'errors' => $messages 
        );
        return $data;
    }

    // field's value isn't null or empty string

    public function required($name, $message = 'This field is required')
    {
        //PresenceOf
        $this->validation->add($name, new \Phalcon\Validation\Validator\PresenceOf(array(
            'message' => $message
        )));
        return $this;
    }
    
    // field's value is the same as a specified value

    public function equal($name, $value, $message = 'Terms and conditions must be accepted')
    {
        //Identical
        $this->validation->add($name, new \Phalcon\Validation\Validator\Identical(array(
            'value' => $value,
            'message' => $message
        )));
        return $this;
    }

    // field contains a valid email format

    public function email($message = 'The e-mail is not valid')
    {
        //Email
        $this->validation->add('email', new \Phalcon\Validation\Validator\Email(array(
            'message' => $message
        )));
        return $this;
    }

    // value is not within a list of possible values

    public function in($name, $value = array(), $message = 'The field must be A or B')
    {
        //InclusionIn
        $this->validation->add($name, new \Phalcon\Validation\Validator\InclusionIn(array(
            'domain' => $value,
            'message' => $message
        )));
        return $this;
    }

    // value is within a list of possible values

    public function not($name, $value = array(), $message = 'The field must not be A or B')
    {
        //ExclusionIn
        $this->validation->add($name, new \Phalcon\Validation\Validator\ExclusionIn(array(
            'domain' => $value,
            'message' => $message
        )));
        return $this;
    }

    // value of a field matches a regular expression

    public function regex($name, $pattern, $message = 'The creation date is invalid')
    {
        //Regex
        switch ($pattern)
        {
            case 'www':
                $value = '/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])$/';
            break;
            
            case 'alias':
                $value = '/^[0-9a-zA-Z_-]++$/iD';
            break;

                    
            default:
                $value = '/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])$/';
            break;
        }

        
        $this->validation->add($name, new \Phalcon\Validation\Validator\Regex(array(
            'pattern' => $value,
            'message' => $message
        )));
        return $this;
    }

    public function inregex($name, $value, $message = 'The creation date is invalid')
    {

        $this->validation->add($name, new \Phalcon\Validation\Validator\Regex(array(
            'pattern' => $value,
            'message' => $message
        )));
        return $this;
    }
    // max and min length of a string

    public function length($name, $length, $type = 'min', $message = 'The field need more')
    {
        //StringLength 
        $msgkey = 'messageMinimum';
        if($type !== 'min')
        {
        $msgkey = 'messageMaximum';
        }
        $this->validation->add($name, new \Phalcon\Validation\Validator\StringLength(array(
            $type => $length,
            $msgkey => $message
        )));
        return $this;
    }

    // value is between two values

    public function between($name, $min, $max, $message = 'The price must be between 0 and 100')
    {
        //Between
        $this->validation->add($name, new \Phalcon\Validation\Validator\Between(array(
            'minimum' => $min,
            'maximum' => $max,
            'message' => $message
        )));
        return $this;
    }

    // Checks that two values have the same value

    public function confirm($name, $confirm, $message = 'Password doesn\'t match confirmation')
    {
        //Confirmation
        $this->validation->add($name, new \Phalcon\Validation\Validator\Confirmation(array(
            'message' => $message,
               'with' => $confirm
        )));
        return $this;
    }

    // Checks that two values have the same value

    public function msg($message = 'Password doesn\'t match confirmation')
    {
        $this->validation->appendMessage($message);
        return $this;
    }

}

