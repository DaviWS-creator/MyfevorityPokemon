<?php
require_once(__DIR__ . "/Geracao.php");
require_once(__DIR__ . "/Tipo.php");

class Pokemon{
    private ?int $id;
    private ?string $nome;
    private ?string $descricao;
    private ?string $urlImage;
    private ?Tipo $tipo;
    private ?Geracao $geracao;


    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of urlImage
     */
    public function getUrlImage(): ?string
    {
        return $this->urlImage;
    }

    /**
     * Set the value of urlImage
     */
    public function setUrlImage(?string $urlImage): self
    {
        $this->urlImage = $urlImage;

        return $this;
    }

    /**
     * Get the value of tipo
     */
    public function getTipo(): ?Tipo
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     */
    public function setTipo(?Tipo $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of geracao
     */
    public function getGeracao(): ?Geracao
    {
        return $this->geracao;
    }

    /**
     * Set the value of geracao
     */
    public function setGeracao(?Geracao $geracao): self
    {
        $this->geracao = $geracao;

        return $this;
    }
}