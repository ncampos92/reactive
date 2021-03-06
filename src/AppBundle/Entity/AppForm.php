<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="appform")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AppFormRepository")
 */
class AppForm
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
     * @ORM\Column(type="string", length=64, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * Many forms are created by one user
     * @ORM\ManyToOne(targetEntity="User", inversedBy="appForms")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * One form has many questions
     * @ORM\OneToMany(targetEntity="Question", mappedBy="appForm", orphanRemoval=true, cascade="remove")
     */
    private $questions;

    /**
     * One form has many form answers
     * @ORM\OneToMany(targetEntity="FormAnswer", mappedBy="appForm", cascade="remove")
     */
    private $formAnswers;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->formAnswers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Form
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Form
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\user $createdBy
     *
     * @return Form
     */
    public function setCreatedBy(\AppBundle\Entity\user $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\user
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Add question
     *
     * @param \AppBundle\Entity\question $question
     *
     * @return Form
     */
    public function addQuestion(\AppBundle\Entity\question $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * Remove question
     *
     * @param \AppBundle\Entity\question $question
     */
    public function removeQuestion(\AppBundle\Entity\question $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Add formAnswer
     *
     * @param \AppBundle\Entity\formanswer $formAnswer
     *
     * @return Form
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
}
