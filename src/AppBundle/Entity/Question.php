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
     * @ORM\ManyToOne(targetEntity="AppForm", inversedBy="questions")
     * @ORM\JoinColumn(name="appform_id", referencedColumnName="id")
     */
    private $appForm;

    /**
     * One question has many answers
     * @ORM\OneToMany(targetEntity="QuestionAnswer", mappedBy="question", cascade="remove")
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

    /**
     * Set appForm
     *
     * @param \AppBundle\Entity\AppForm $appForm
     *
     * @return Question
     */
    public function setAppForm(\AppBundle\Entity\AppForm $appForm = null)
    {
        $this->appForm = $appForm;

        return $this;
    }

    /**
     * Get appForm
     *
     * @return \AppBundle\Entity\AppForm
     */
    public function getAppForm()
    {
        return $this->appForm;
    }

    /**
     * Get answers which value is type
     *
     * @param string $type
     *
     * @return integer
     */
    public function getQuestionAnswerCount($type)
    {
        $count = 0;
        foreach ($this->getQuestionAnswers() as $questionAnswer) {
            if ($questionAnswer->getValue() == $type) {
                $count++;
            }
        }
        return $count;
    }
}
