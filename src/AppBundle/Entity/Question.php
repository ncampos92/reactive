<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * Many questions relate to one form
     * @ORM\ManyToOne(targetEntity="Form", inversedBy="questions")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id")
     */
    private $form;

    /**
     * One question has many answers
     * @ORM\OneToMany(targetEntity="QuestionAnswer", mappedBy="question")
     */
    private $questionAnswers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questionAnswers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set text
     *
     * @param string $text
     *
     * @return Question
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set form
     *
     * @param \AppBundle\Entity\form $form
     *
     * @return Question
     */
    public function setForm(\AppBundle\Entity\form $form = null)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get form
     *
     * @return \AppBundle\Entity\form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Add questionAnswer
     *
     * @param \AppBundle\Entity\questionanswer $questionAnswer
     *
     * @return Question
     */
    public function addQuestionAnswer(\AppBundle\Entity\questionanswer $questionAnswer)
    {
        $this->questionAnswers[] = $questionAnswer;

        return $this;
    }

    /**
     * Remove questionAnswer
     *
     * @param \AppBundle\Entity\questionanswer $questionAnswer
     */
    public function removeQuestionAnswer(\AppBundle\Entity\questionanswer $questionAnswer)
    {
        $this->questionAnswers->removeElement($questionAnswer);
    }

    /**
     * Get questionAnswers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestionAnswers()
    {
        return $this->questionAnswers;
    }
}
