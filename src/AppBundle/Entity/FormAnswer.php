<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="formanswer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormAnswerRepository")
 */
class FormAnswer
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
     * Many form answers have one user
     * @ORM\ManyToOne(targetEntity="user", inversedBy="formAnswers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Many form answers have one form
     * @ORM\ManyToOne(targetEntity="form", inversedBy="formAnswers")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id")
     */
    private $form;

    /**
     * One form answer has many question answers
     * @ORM\OneToMany(targetEntity="questionanswer", mappedBy="formanswer")
     */
    private $questionAnswers;
}
