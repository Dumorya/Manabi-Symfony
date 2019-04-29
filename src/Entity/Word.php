<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WordRepository")
 */
class Word
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $from_word;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $to_translation;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WordsList", inversedBy="word_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $words_list_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromWord(): ?string
    {
        return $this->from_word;
    }

    public function setFromWord(string $from_word): self
    {
        $this->from_word = $from_word;

        return $this;
    }

    public function getToTranslation(): ?string
    {
        return $this->to_translation;
    }

    public function setToTranslation(string $to_translation): self
    {
        $this->to_translation = $to_translation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWordsListId(): ?WordsList
    {
        return $this->words_list_id;
    }

    public function setWordsListId(?WordsList $words_list_id): self
    {
        $this->words_list_id = $words_list_id;

        return $this;
    }
}
