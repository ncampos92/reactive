<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="questionanswer", uniqueConstraints={@ORM\UniqueConstraint(name="unique_answer", columns={"question_id", "form_answer_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionAnswerRepository")
 */
class QuestionAnswer
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
     * Many question answers have one question
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="questionAnswers")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

    /**
     * Many questions answers relate to one form answer
     * @ORM\ManyToOne(targetEntity="FormAnswer", inversedBy="questionAnswers")
     * @ORM\JoinColumn(name="form_answer_id", referencedColumnName="id")
     */
    private $formAnswer;

    /**
     * @var string
     * @ORM\Column(type="string", length=2)
     * cumple=cu, no cumple=nc, no aplica=na
     */
    private $value;

    /**
     * Set value
     *
     * @param string $value
     *
     * @return QuestionAnswer
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set question
     *
     * @param \AppBundle\Entity\Question $question
     *
     * @return QuestionAnswer
     */
    public function setQuestion(\AppBundle\Entity\Question $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \AppBundle\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set formAnswer
     *
     * @param \AppBundle\Entity\formanswer $formAnswer
     *
     * @return QuestionAnswer
     */
    public function setFormAnswer(\AppBundle\Entity\formanswer $formAnswer)
    {
        $this->formAnswer = $formAnswer;

        return $this;
    }

    /**
     * Get formAnswer
     *
     * @return \AppBundle\Entity\formanswer
     */
    public function getFormAnswer()
    {
        return $this->formAnswer;
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
}
