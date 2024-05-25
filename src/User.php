<?php
class User
{
    public int $id;
    public string $name;
    public string $email;
    public string $color_name; // Assuming color is stored as a name

    /**
     * User constructor.
     *
     * @param int $id User ID
     * @param string $name User name
     * @param string $email User email
     * @param string $color_name (optional) User's associated color name
     */
    public function __construct(int $id, string $name, string $email, string $color_name = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->color_name = $color_name;
    }

    /**
     * Get user's full name (optional method)
     *
     * @return string User's full name (if available)
     */
    public function getFullName(): string
    {
        if (!empty($this->name)) {
            return $this->name;
        } else {
            return 'N/A';
        }
    }
}
