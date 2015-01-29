<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class FinancialResource
 *
 * @ODM\Document(collection="financial_resource", repositoryClass="AppBundle\Repository\CommonRepository")
 */
class FinancialResource extends AbstractResource
{
    /**
     * @var integer
     *
     * @ODM\Id
     */
    private $id;

    /**
     * @var string $title
     *
     * @ODM\Field(type="string")
     */
    protected $title;

    /**
     * @var date $createdAt
     *
     * @ODM\Field(type="date")
     */
    protected $createdAt;

    /**
     * @var float $quantity
     *
     * @ODM\Field(type="float")
     */
    protected $quantity;

    /**
     * @var \AppBundle\Document\Dream
     *
     * @ODM\ReferenceOne(targetDocument="Dream", inversedBy="dreamFinancialContributions")
     */
    protected $dream;

    /**
     * @var array
     *
     * @ODM\ReferenceMany(targetDocument="FinancialContribute", mappedBy="financialResource")
     */
    protected $financialContributes = array();

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param  string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set createdAt
     *
     * @param  date $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set quantity
     *
     * @param  float $quantity
     * @return self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float $quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set dream
     *
     * @param  \AppBundle\Document\Dream $dream
     * @return self
     */
    public function setDream(\AppBundle\Document\Dream $dream)
    {
        $this->dream = $dream;

        return $this;
    }

    /**
     * Get dream
     *
     * @return \AppBundle\Document\Dream $dream
     */
    public function getDream()
    {
        return $this->dream;
    }
}
