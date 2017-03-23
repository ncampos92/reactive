<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="questionanswer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionAnswerRepository")
 */
class QuestionAnswer
{
    /**
     * Many question answers have one question
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="questionAnswers")
     * @ORM\JoinColum(name="question_id", referencedColumnName="id")
     */
    private $question;

    /**
     * Many questions answers relate to one form answer
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="formanswer", inversedBy="questionAnswers")
     * @ORM\JoinColumn(name="form_answer_id", referencedColumnName="id")
     */
    private $formAnswer;

    /**
     * @var string
     * @ORM\Column(type="string", length=2)
     * cumple=cu, no cumple=nc, no aplica=na
     */
    private $value;
}
