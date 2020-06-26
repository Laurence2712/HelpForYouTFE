<?php 

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class RequestSearch{

    /**
     * @var int|null
     * @Assert\Range(min=1300, max=6000, minMessage="Le code postal doit se situer entre 1300 et 6000")
     * @Assert\Regex("/^[0-9]{4}$/")
     */

    private $postalCode;


    /**
     * @var string|null
     */
    private $city;

    /**
     * @var string|null
     */
    private $category;

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

     /**
     * @param string|null $category
     * @return RequestSearch
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @param string|null $category
     * @return RequestSearch
     */
    public function setCategory(?int $category): RequestSearch
    {
        $this->category = $category;
        return $this;
    }



}