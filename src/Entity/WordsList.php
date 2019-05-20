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
     * @ORM\OneToMany(targetEntity="App\Entity\Word", mappedBy="words_list", orphanRemoval=true)
     */
    private $words;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="wordsLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->words = new ArrayCollection();
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
    public function getWords(): Collection
    {
        return $this->words;
    }

    public function addWordId(Word $wordId): self
    {
        if (!$this->words->contains($wordId)) {
            $this->words[] = $wordId;
            $wordId->setWordsList($this);
        }

        return $this;
    }

    public function removeWordId(Word $wordId): self
    {
        if ($this->words->contains($wordId)) {
            $this->words->removeElement($wordId);
            // set the owning side to null (unless already changed)
            if ($wordId->getWordsList() === $this) {
                $wordId->setWordsList(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
