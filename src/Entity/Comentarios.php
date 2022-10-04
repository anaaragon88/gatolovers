<?php

namespace App\Entity;

use App\Repository\ComentariosRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentariosRepository::class)]
class Comentarios
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $comentario = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_post = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'comentarios')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Posts::class, inversedBy: 'comentarios')]
    private $posts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getFechaPost(): ?\DateTimeInterface
    {
        return $this->fecha_post;
    }

    public function setFechaPost(\DateTimeInterface $fecha_post): self
    {
        $this->fecha_post = $fecha_post;

        return $this;
    }
}
