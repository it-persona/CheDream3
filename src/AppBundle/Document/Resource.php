<?php

namespace AppBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Type;

/**
 * @ODM\Document
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField("type")
 * @ODM\DiscriminatorMap({"WorkResource" = "WorkResource", "FinancialResource" = "FinancialResource", "EquipmentResource" = "EquipmentResource"})
 * @ExclusionPolicy("all")
 */
class Resource
{
    use Timestampable;
    /**
     * @ODM\Id(strategy="AUTO")
     * @Expose()
     * @Type("integer")
     */
    protected $id;

    /**
     * @ODM\ReferenceOne(targetDocument="AppBundle\Document\Dream")
     * @Expose()
     * @Type("AppBundle\Document\Dream")
     */
    protected $dream;

    /**
     * @ODM\ReferenceMany(targetDocument="AppBundle\Document\Contribute")
     * @Expose()
     * @Type("array<AppBundle\Document\Contribute>")
     */
    protected $contributes = [];

    /**
     * @var string $title
     *
     * @ODM\Field(type="string")
     * @Assert\NotBlank()
     * @Expose()
     * @Type("string")
     */
    protected $title;

    /**
     * @var float $quantity
     *
     * @ODM\Field(type="float")
     * @Expose()
     * @Type("float")
     */
    protected $quantity;

    public function __construct()
    {
        $this->contributes = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * Add contribute
     *
     * @param \AppBundle\Document\Contribute $contribute
     */
    public function addContribute(\AppBundle\Document\Contribute $contribute)
    {
        $this->contributes[] = $contribute;
    }

    /**
     * Remove contribute
     *
     * @param \AppBundle\Document\Contribute $contribute
     */
    public function removeContribute(\AppBundle\Document\Contribute $contribute)
    {
        $this->contributes->removeElement($contribute);
    }

    /**
     * Get contributes
     *
     * @return \Doctrine\Common\Collections\Collection $contributes
     */
    public function getContributes()
    {
        return $this->contributes;
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
}
