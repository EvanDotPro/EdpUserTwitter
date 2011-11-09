<?php

namespace EdpUserTwitter\Model;

use Doctrine\ORM\Mapping as ORM,
    DateTime,
    EdpCommon\Model\ModelAbstract;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_twitter")
 */
class UserTwitter extends ModelAbstract
{
    /**
     * @ORM\OneToOne(targetEntity="EdpUser\Model\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @ORM\Id
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO") 
     */
    private $userId;

    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $twitter;

    /**
     * Get user.
     *
     * @return user
     */
    public function getUser()
    {
        return $this->user;
    }
 
    /**
     * Set user.
     *
     * @param $user the value to be set
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
 
    /**
     * Get userId.
     *
     * @return userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
 
    /**
     * Set userId.
     *
     * @param $userId the value to be set
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Get twitter.
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
 
    /**
     * Set twitter.
     *
     * @param string $twitter the value to be set
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
        return $this;
    }

    public function __toString()
    {
        return $this->getTwitter();
    }
 
}
