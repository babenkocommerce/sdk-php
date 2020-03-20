<?php

namespace net\authorize\api\contract\v1;

/**
 * Class representing ValidateCustomerPaymentProfileResponse
 */
class ValidateCustomerPaymentProfileResponse extends ANetApiResponseType
{

    /**
     * @property string $directResponse
     */
    private $directResponse = null;

    /**
     * Gets as directResponse
     *
     * @return string
     */
    public function getDirectResponse()
    {
        return $this->directResponse;
    }

    /**
     * Sets a new directResponse
     *
     * @param string $directResponse
     * @return self
     */
    public function setDirectResponse($directResponse)
    {
        $this->directResponse = $directResponse;
        return $this;
    }


    /**
     * @param $data
     * @throws \Exception
     * @return void
     */
    public function set($data)
    {
        if(is_array($data) || is_object($data)) {
            $mapper = \net\authorize\util\Mapper::Instance();
            foreach($data AS $key => $value) {
                $classDetails = $mapper->getClass(get_class() , $key);
     
                if($classDetails !== NULL ) {
                    if ($classDetails->isArray) {
                        if ($classDetails->isCustomDefined) {
                            foreach($value AS $keyChild => $valueChild) {
                                $type = new $classDetails->className;
                                $type->set($valueChild);
                                $this->{'addTo' . $key}($type);
                            }
                        }
                        else if ($classDetails->className === 'DateTime' || $classDetails->className === 'Date' ) {
                            foreach($value AS $keyChild => $valueChild) {
                                $type = new \DateTime($valueChild);
                                $this->{'addTo' . $key}($type);
                            }
                        }
                        else {
                            foreach($value AS $keyChild => $valueChild) {
                                $this->{'addTo' . $key}($valueChild);
                            }
                        }
                    }
                    else {
                        if ($classDetails->isCustomDefined){
                            $type = new $classDetails->className;
                            $type->set($value);
                            $this->{'set' . $key}($type);
                        }
                        else if ($classDetails->className === 'DateTime' || $classDetails->className === 'Date' ) {
                            $type = new \DateTime($value);
                            $this->{'set' . $key}($type);
                        }
                        else {
                            $this->{'set' . $key}($value);
                        }
                    }
                }
            }
        }
    }
    
}

