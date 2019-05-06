<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WordsListRepository")
 */
class WordsList
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Word", mappedBy="words_list_id", orphanRemoval=true)
     */
    private $word_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="wordsLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    public function __construct()
    {
        $this->word_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Word[]
     */
    public function getWordId(): Collection
    {
        return $this->word_id;
    }

    public function addWordId(Word $wordId): self
    {
        if (!$this->word_id->contains($wordId)) {
            $this->word_id[] = $wordId;
            $wordId->setWordsListId($this);
        }

        return $this;
    }

    public function removeWordId(Word $wordId): self
    {
        if ($this->word_id->contains($wordId)) {
            $this->word_id->removeElement($wordId);
            // set the owning side to null (unless already changed)
            if ($wordId->getWordsListId() === $this) {
                $wordId->setWordsListId(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}
