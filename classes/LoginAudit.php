<?php


class LoginAudit
{
    private int $id;
    private string $email;
    private ?string $time;
    private ?string $login_method;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getTime(): ?string
    {
        return $this->time;
    }

    /**
     * @param string|null $time
     */
    public function setTime(?string $time): void
    {
        $this->time = $time;
    }

    /**
     * @return string|null
     */
    public function getLoginMethod(): ?string
    {
        return $this->login_method;
    }

    /**
     * @param string|null $login_method
     */
    public function setLoginMethod(?string $login_method): void
    {
        $this->login_method = $login_method;
    }
    public function toArray(){
        return array(
            "id" => $this->id,
            "email" => $this->email,
            "time" => $this->time,
            "login_method" => $this->login_method
        );
    }
}