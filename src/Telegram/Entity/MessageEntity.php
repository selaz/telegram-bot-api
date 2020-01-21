<?php

namespace Selaz\Telegram\Entity;

class MessageEntity extends Entity {
    protected $type;
    protected $offset;
    protected $length;
    protected $url;

    /**
     * Type of the entity. One of mention (@username), hashtag, bot_command, url, email, bold (bold text), 
     * italic (italic text), code (monowidth string), pre (monowidth block), text_link (for clickable text URLs)
     */
    public function setType(string $type) {
        $this->type = $type;
    }

    /**
     * Type of the entity. One of mention (@username), hashtag, bot_command, url, email, bold (bold text), 
     * italic (italic text), code (monowidth string), pre (monowidth block), text_link (for clickable text URLs)
     */
    public function getType(): ?string {
        return $this->type;
    }

    /**
     * Offset in UTF-16 code units to the start of the entity
     */
    public function setOffset(int $offset) {
        $this->offset = $offset;
    }

    /**
     * Offset in UTF-16 code units to the start of the entity
     */
    public function getOffset(): ?int {
        return $this->offset;
    }

    /**
     * Length of the entity in UTF-16 code units
     */
    public function setLength(int $length) {
        $this->length = $length;
    }

    /**
     * Length of the entity in UTF-16 code units
     */
    public function getLength(): ?int {
        return $this->length;
    }

    /**
     * For “text_link” only, url that will be opened after user taps on the text
     */
    public function setUrl(string $url) {
        $this->url = $url;
    }

    /**
     * For “text_link” only, url that will be opened after user taps on the text
     */
    public function getUrl(): ?string {
        return $this->url;
    }
}