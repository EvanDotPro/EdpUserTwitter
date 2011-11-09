<?php

namespace EdpUserTwitter\Model;

use Doctrine\ORM\Mapping as ORM,
    EdpCommon\Model\ModelAbstract;

/**
 * @ORM\Entity
 */
class UserTwitter extends ModelAbstract
{
    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Application\EdpUser\Model\User", inversedBy="twitter")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @ORM\Column(name="twitter_username", type="string", unique=true)
     */
    private $twitterUsername;

    /**
     * __construct 
     * 
     * @param mixed $user 
     * @param string $twitterUsername 
     * @return void
     */
    public function __construct($user, $twitterUsername)
    {
        $this->setUser($user);
        $this->setTwitterUsername($twitterUsername);
    }

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
     * Get twitterUsername.
     *
     * @return twitterUsername
     */
    public function getTwitterUsername()
    {
        return $this->twitterUsername;
    }
 
    /**
     * Set twitterUsername.
     *
     * @param $twitterUsername the value to be set
     */
    public function setTwitterUsername($twitterUsername)
    {
        $this->twitterUsername = $twitterUsername;
        return $this;
    }
 
    public function __toString()
    {
        return $this->twitterUsername;
    }
}
