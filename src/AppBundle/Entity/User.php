<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

//http://symfony.com/doc/2.8/security/entity_provider.html#security-crete-user-entity

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;

    /**
     * One user creates many forms
     * @ORM\OneToMany(targetEntity="AppForm", mappedBy="createdBy", cascade="remove")
     */
    private $appForms;

    /**
     * One user has many form answers
     * @ORM\OneToMany(targetEntity="FormAnswer", mappedBy="user", cascade="remove")
     */
    private $formAnswers;

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password
        ) = unserialize($serialized);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formAnswers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add formAnswer
     *
     * @param \AppBundle\Entity\formanswer $formAnswer
     *
     * @return User
     */
    public function addFormAnswer(\AppBundle\Entity\formanswer $formAnswer)
    {
        $this->formAnswers[] = $formAnswer;

        return $this;
    }

    /**
     * Remove formAnswer
     *
     * @param \AppBundle\Entity\formanswer $formAnswer
     */
    public function removeFormAnswer(\AppBundle\Entity\formanswer $formAnswer)
    {
        $this->formAnswers->removeElement($formAnswer);
    }

    /**
     * Get formAnswers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormAnswers()
    {
        return $this->formAnswers;
    }

    /**
     * Add appForm
     *
     * @param \AppBundle\Entity\AppForm $appForm
     *
     * @return User
     */
    public function addAppForm(\AppBundle\Entity\AppForm $appForm)
    {
        $this->appForms[] = $appForm;

        return $this;
    }

    /**
     * Remove appForm
     *
     * @param \AppBundle\Entity\AppForm $appForm
     */
    public function removeAppForm(\AppBundle\Entity\AppForm $appForm)
    {
        $this->appForms->removeElement($appForm);
    }

    /**
     * Get appForms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppForms()
    {
        return $this->appForms;
    }
}
