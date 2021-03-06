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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="formAnswers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Many form answers have one form
     * @ORM\ManyToOne(targetEntity="AppForm", inversedBy="formAnswers")
     * @ORM\JoinColumn(name="appform_id", referencedColumnName="id")
     */
    private $appForm;

    /**
     * One form answer has many question answers
     * @ORM\OneToMany(targetEntity="QuestionAnswer", mappedBy="formAnswer", cascade={"persist", "remove"})
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
     * Set user
     *
     * @param \AppBundle\Entity\user $user
     *
     * @return FormAnswer
     */
    public function setUser(\AppBundle\Entity\user $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add questionAnswer
     *
     * @param \AppBundle\Entity\questionanswer $questionAnswer
     *
     * @return FormAnswer
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
     * @return FormAnswer
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
}
