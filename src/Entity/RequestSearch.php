<?php 

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class RequestSearch{

    /**
     * @var int|null
     * @Assert\Range(min=1300, max=1495, minMessage="Le code postal doit se situer entre 1300 et 1495")
     * @Assert\Regex("/^[0-9]{4}$/")
     */

    private $postalCode;


    /**
     * @var string|null
     */
    private $city;


    /**
     * @param int|null $postalCode
     * @return RequestSearch
     */
    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    /**
     * @param int|null $postalCode
     * @return RequestSearch
     */
    public function setPostalCode(?int $postalCode): RequestSearch
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @param string|null $city
     * @return RequestSearch
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return RequestSearch
     */
    public function setCity(?int $city): RequestSearch
    {
        $this->city = $city;
        return $this;
    }




}