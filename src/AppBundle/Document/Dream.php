<?php

namespace AppBundle\Document;

use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class Dream
 * @package AppBundle\Document
 *
 * @ODM\Document(collection="dreams", repositoryClass="AppBundle\Repository\DreamRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ExclusionPolicy("all")
 */
class Dream
{
    /**
     * @var integer
     *
     * @ODM\Id
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "dream.not_blank")
     * @Assert\Length(min = "5", minMessage = "dream.min_length")
     * @ODM\Field(type="string")
     */
    protected $title;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "dream.not_blank")
     * @ODM\Field(type="string")
     */
    protected $description;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $rejectedDescription;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $implementedDescription;

    /**
     * @var string
     *
     * @ODM\Field(type="string")
     */
    protected $completedDescription;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "dream.not_blank")
     * @Assert\Regex(pattern="/^[+0-9 ()-]+$/", message="dream.only_numbers")
     * @ODM\Field(type="string")
     */
    protected $phone;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"})
     * @ODM\Field(type="string")
     */
    protected $slug;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ODM\Field(type="date")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ODM\Field(type="date")
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     *
     * @ODM\Field(type="date")
     */
    protected $deletedAt;

    /**
     * @var \DateTime
     *
     * @ODM\Field(type="date")
     */
    protected $expiredDate;

    /**
     * @var integer
     *
     * @ODM\Field(type="int")
     */
    protected $financialCompleted;

    /**
     * @var integer
     *
     * @ODM\Field(type="int")
     */
    protected $workCompleted;

    /**
     * @var integer
     *
     * @ODM\Field(type="int")
     */
    protected $equipmentCompleted;

    /**
     * @ODM\ReferenceMany(targetDocument="User")
     */
    protected $usersWhoFavorites = array();

    /**
     * @var integer
     *
     * @ODM\Field(type="int")
     */
    protected $favoritesCount;

    /**
     * @ODM\ReferenceOne(targetDocument="User")
     * @MaxDepth(1)
     * @Expose()
     */
    protected $author;

    /**
     * @ODM\ReferenceMany(targetDocument="Status", cascade={"persist"})
     */
    protected $statuses = array();

    /**
     * @ODM\Field(type="string")
     */
    protected $currentStatus;

//    /**
//     * @ODM\ManyToMany(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
//     */
//    protected $mediaPictures;

//    /**
//     * @ODM\ReferenceMany(targetDocument="Application\Sonata\MediaBundle\Entity\Media")
//     */
////    protected $mediaCompletedPictures;
//
//    /**
//     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
//     */
//    protected $mediaPoster;
//
//    /**
//     * @ORM\ManyToMany(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
//     * @ORM\JoinTable(name="mediaFiles_media")
//     */
//    protected $mediaFiles;
//
//    /**
//     * @ORM\ManyToMany(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
//     * @ORM\JoinTable(name="mediaVideos_media")
//     */
//    protected $mediaVideos;

    protected $dreamPictures;
    protected $dreamPoster;
    protected $dreamFiles;
    protected $dreamVideos;

    /**
     * @ODM\ReferenceMany(targetDocument="FinancialResource", cascade={"persist"})
     */
    protected $dreamFinancialResources;

    /**
     * @ODM\ReferenceMany(targetDocument="EquipmentResource", cascade={"persist"})
     */
    protected $dreamEquipmentResources;

    /**
     * @ODM\ReferenceMany(targetDocument="WorkResource", cascade={"persist"})
     */
    protected $dreamWorkResources;

    /**
     * @ODM\ReferenceMany(targetDocument="OtherContribute")
     */
    protected $dreamOtherContributions;

    public function __construct()
    {
        $this->usersWhoFavorites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statuses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dreamFinancialResources = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dreamEquipmentResources = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dreamWorkResources = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dreamFinancialContributions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dreamEquipmentContributions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dreamWorkContributions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dreamOtherContributions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set description
     *
     * @param  string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set rejectedDescription
     *
     * @param  string $rejectedDescription
     * @return self
     */
    public function setRejectedDescription($rejectedDescription)
    {
        $this->rejectedDescription = $rejectedDescription;

        return $this;
    }

    /**
     * Get rejectedDescription
     *
     * @return string $rejectedDescription
     */
    public function getRejectedDescription()
    {
        return $this->rejectedDescription;
    }

    /**
     * Set implementedDescription
     *
     * @param  string $implementedDescription
     * @return self
     */
    public function setImplementedDescription($implementedDescription)
    {
        $this->implementedDescription = $implementedDescription;

        return $this;
    }

    /**
     * Get implementedDescription
     *
     * @return string $implementedDescription
     */
    public function getImplementedDescription()
    {
        return $this->implementedDescription;
    }

    /**
     * Set completedDescription
     *
     * @param  string $completedDescription
     * @return self
     */
    public function setCompletedDescription($completedDescription)
    {
        $this->completedDescription = $completedDescription;

        return $this;
    }

    /**
     * Get completedDescription
     *
     * @return string $completedDescription
     */
    public function getCompletedDescription()
    {
        return $this->completedDescription;
    }

    /**
     * Set phone
     *
     * @param  string $phone
     * @return self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set slug
     *
     * @param  string $slug
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Set updatedAt
     *
     * @param  date $updatedAt
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return date $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param  date $deletedAt
     * @return self
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return date $deletedAt
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set expiredDate
     *
     * @param  date $expiredDate
     * @return self
     */
    public function setExpiredDate($expiredDate)
    {
        $this->expiredDate = $expiredDate;

        return $this;
    }

    /**
     * Get expiredDate
     *
     * @return date $expiredDate
     */
    public function getExpiredDate()
    {
        return $this->expiredDate;
    }

    /**
     * Set financialCompleted
     *
     * @param  int  $financialCompleted
     * @return self
     */
    public function setFinancialCompleted($financialCompleted)
    {
        $this->financialCompleted = $financialCompleted;

        return $this;
    }

    /**
     * Get financialCompleted
     *
     * @return int $financialCompleted
     */
    public function getFinancialCompleted()
    {
        return $this->financialCompleted;
    }

    /**
     * Set workCompleted
     *
     * @param  int  $workCompleted
     * @return self
     */
    public function setWorkCompleted($workCompleted)
    {
        $this->workCompleted = $workCompleted;

        return $this;
    }

    /**
     * Get workCompleted
     *
     * @return int $workCompleted
     */
    public function getWorkCompleted()
    {
        return $this->workCompleted;
    }

    /**
     * Set equipmentCompleted
     *
     * @param  int  $equipmentCompleted
     * @return self
     */
    public function setEquipmentCompleted($equipmentCompleted)
    {
        $this->equipmentCompleted = $equipmentCompleted;

        return $this;
    }

    /**
     * Get equipmentCompleted
     *
     * @return int $equipmentCompleted
     */
    public function getEquipmentCompleted()
    {
        return $this->equipmentCompleted;
    }

    /**
     * Add usersWhoFavorite
     *
     * @param \AppBundle\Document\User $usersWhoFavorite
     */
    public function addUsersWhoFavorite(\AppBundle\Document\User $usersWhoFavorite)
    {
        $this->usersWhoFavorites[] = $usersWhoFavorite;
    }

    /**
     * Remove usersWhoFavorite
     *
     * @param \AppBundle\Document\User $usersWhoFavorite
     */
    public function removeUsersWhoFavorite(\AppBundle\Document\User $usersWhoFavorite)
    {
        $this->usersWhoFavorites->removeElement($usersWhoFavorite);
    }

    /**
     * Get usersWhoFavorites
     *
     * @return \Doctrine\Common\Collections\Collection $usersWhoFavorites
     */
    public function getUsersWhoFavorites()
    {
        return $this->usersWhoFavorites;
    }

    /**
     * Set favoritesCount
     *
     * @param  int  $favoritesCount
     * @return self
     */
    public function setFavoritesCount($favoritesCount)
    {
        $this->favoritesCount = $favoritesCount;

        return $this;
    }

    /**
     * Get favoritesCount
     *
     * @return int $favoritesCount
     */
    public function getFavoritesCount()
    {
        return $this->favoritesCount;
    }

    /**
     * Set author
     *
     * @param  \AppBundle\Document\User $author
     * @return self
     */
    public function setAuthor(\AppBundle\Document\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \AppBundle\Document\User $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add status
     *
     * @param \AppBundle\Document\Status $status
     */
    public function addStatus(\AppBundle\Document\Status $status)
    {
        $this->statuses[] = $status;
    }

    /**
     * Remove status
     *
     * @param \AppBundle\Document\Status $status
     */
    public function removeStatus(\AppBundle\Document\Status $status)
    {
        $this->statuses->removeElement($status);
    }

    /**
     * Get statuses
     *
     * @return \Doctrine\Common\Collections\Collection $statuses
     */
    public function getStatuses()
    {
        return $this->statuses;
    }

    /**
     * Set currentStatus
     *
     * @param  string $currentStatus
     * @return self
     */
    public function setCurrentStatus($currentStatus)
    {
        $this->currentStatus = $currentStatus;

        return $this;
    }

    /**
     * Get currentStatus
     *
     * @return string $currentStatus
     */
    public function getCurrentStatus()
    {
        return $this->currentStatus;
    }

    /**
     * Add dreamFinancialResource
     *
     * @param \AppBundle\Document\FinancialResource $dreamFinancialResource
     */
    public function addDreamFinancialResource(\AppBundle\Document\FinancialResource $dreamFinancialResource)
    {
        $this->dreamFinancialResources[] = $dreamFinancialResource;
    }

    /**
     * Remove dreamFinancialResource
     *
     * @param \AppBundle\Document\FinancialResource $dreamFinancialResource
     */
    public function removeDreamFinancialResource(\AppBundle\Document\FinancialResource $dreamFinancialResource)
    {
        $this->dreamFinancialResources->removeElement($dreamFinancialResource);
    }

    /**
     * Get dreamFinancialResources
     *
     * @return \Doctrine\Common\Collections\Collection $dreamFinancialResources
     */
    public function getDreamFinancialResources()
    {
        return $this->dreamFinancialResources;
    }

    /**
     * Add dreamEquipmentResource
     *
     * @param \AppBundle\Document\EquipmentResource $dreamEquipmentResource
     */
    public function addDreamEquipmentResource(\AppBundle\Document\EquipmentResource $dreamEquipmentResource)
    {
        $this->dreamEquipmentResources[] = $dreamEquipmentResource;
    }

    /**
     * Remove dreamEquipmentResource
     *
     * @param \AppBundle\Document\EquipmentResource $dreamEquipmentResource
     */
    public function removeDreamEquipmentResource(\AppBundle\Document\EquipmentResource $dreamEquipmentResource)
    {
        $this->dreamEquipmentResources->removeElement($dreamEquipmentResource);
    }

    /**
     * Get dreamEquipmentResources
     *
     * @return \Doctrine\Common\Collections\Collection $dreamEquipmentResources
     */
    public function getDreamEquipmentResources()
    {
        return $this->dreamEquipmentResources;
    }

    /**
     * Add dreamWorkResource
     *
     * @param \AppBundle\Document\WorkResource $dreamWorkResource
     */
    public function addDreamWorkResource(\AppBundle\Document\WorkResource $dreamWorkResource)
    {
        $this->dreamWorkResources[] = $dreamWorkResource;
    }

    /**
     * Remove dreamWorkResource
     *
     * @param \AppBundle\Document\WorkResource $dreamWorkResource
     */
    public function removeDreamWorkResource(\AppBundle\Document\WorkResource $dreamWorkResource)
    {
        $this->dreamWorkResources->removeElement($dreamWorkResource);
    }

    /**
     * Get dreamWorkResources
     *
     * @return \Doctrine\Common\Collections\Collection $dreamWorkResources
     */
    public function getDreamWorkResources()
    {
        return $this->dreamWorkResources;
    }

    /**
     * Add dreamFinancialContribution
     *
     * @param \AppBundle\Document\FinancialContribute $dreamFinancialContribution
     */
    public function addDreamFinancialContribution(\AppBundle\Document\FinancialContribute $dreamFinancialContribution)
    {
        $this->dreamFinancialContributions[] = $dreamFinancialContribution;
    }

    /**
     * Remove dreamFinancialContribution
     *
     * @param \AppBundle\Document\FinancialContribute $dreamFinancialContribution
     */
    public function removeDreamFinancialContribution(\AppBundle\Document\FinancialContribute $dreamFinancialContribution)
    {
        $this->dreamFinancialContributions->removeElement($dreamFinancialContribution);
    }

    /**
     * Get dreamFinancialContributions
     *
     * @return \Doctrine\Common\Collections\Collection $dreamFinancialContributions
     */
    public function getDreamFinancialContributions()
    {
        return $this->dreamFinancialContributions;
    }

    /**
     * Add dreamEquipmentContribution
     *
     * @param \AppBundle\Document\EquipmentContribute $dreamEquipmentContribution
     */
    public function addDreamEquipmentContribution(\AppBundle\Document\EquipmentContribute $dreamEquipmentContribution)
    {
        $this->dreamEquipmentContributions[] = $dreamEquipmentContribution;
    }

    /**
     * Remove dreamEquipmentContribution
     *
     * @param \AppBundle\Document\EquipmentContribute $dreamEquipmentContribution
     */
    public function removeDreamEquipmentContribution(\AppBundle\Document\EquipmentContribute $dreamEquipmentContribution)
    {
        $this->dreamEquipmentContributions->removeElement($dreamEquipmentContribution);
    }

    /**
     * Get dreamEquipmentContributions
     *
     * @return \Doctrine\Common\Collections\Collection $dreamEquipmentContributions
     */
    public function getDreamEquipmentContributions()
    {
        return $this->dreamEquipmentContributions;
    }

    /**
     * Add dreamWorkContribution
     *
     * @param \AppBundle\Document\WorkContribute $dreamWorkContribution
     */
    public function addDreamWorkContribution(\AppBundle\Document\WorkContribute $dreamWorkContribution)
    {
        $this->dreamWorkContributions[] = $dreamWorkContribution;
    }

    /**
     * Remove dreamWorkContribution
     *
     * @param \AppBundle\Document\WorkContribute $dreamWorkContribution
     */
    public function removeDreamWorkContribution(\AppBundle\Document\WorkContribute $dreamWorkContribution)
    {
        $this->dreamWorkContributions->removeElement($dreamWorkContribution);
    }

    /**
     * Get dreamWorkContributions
     *
     * @return \Doctrine\Common\Collections\Collection $dreamWorkContributions
     */
    public function getDreamWorkContributions()
    {
        return $this->dreamWorkContributions;
    }

    /**
     * Add dreamOtherContribution
     *
     * @param \AppBundle\Document\OtherContribute $dreamOtherContribution
     */
    public function addDreamOtherContribution(\AppBundle\Document\OtherContribute $dreamOtherContribution)
    {
        $this->dreamOtherContributions[] = $dreamOtherContribution;
    }

    /**
     * Remove dreamOtherContribution
     *
     * @param \AppBundle\Document\OtherContribute $dreamOtherContribution
     */
    public function removeDreamOtherContribution(\AppBundle\Document\OtherContribute $dreamOtherContribution)
    {
        $this->dreamOtherContributions->removeElement($dreamOtherContribution);
    }

    /**
     * Get dreamOtherContributions
     *
     * @return \Doctrine\Common\Collections\Collection $dreamOtherContributions
     */
    public function getDreamOtherContributions()
    {
        return $this->dreamOtherContributions;
    }
}
