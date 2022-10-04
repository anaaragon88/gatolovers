<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $likes = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_post = null;

    #[ORM\Column(length: 8000)]
    private ?string $contenido = null;

    #[ORM\OneToMany(targetEntity: Comentarios::class, mappedBy: 'posts')]
    private $comentarios;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'posts')]
    private $user;

    /**
     * Posts constructor.
     */
    public function __construct()
    {
        $this->likes='';
        $this->fecha_post= new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getLikes(): ?string
    {
        return $this->likes;
    }

    public function setLikes(?string $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

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

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * @param mixed $comentarios
     */
    public function setComentarios($comentarios): void
    {
        $this->comentarios = $comentarios;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
}
