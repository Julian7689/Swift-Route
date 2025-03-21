<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PedidoEnviado extends Notification
{
    use Queueable;

    protected $pedido;

    /**
     * Create a new notification instance.
     */
    public function __construct($pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Tu pedido ha sido enviado')
            ->greeting("Hola, {$notifiable->name}")
            ->line("Tu pedido con el ID: {$this->pedido->id} ha sido enviado.")
            ->line("Dirección de envío: {$this->pedido->direccion_envio}")
            ->line("Estado: {$this->pedido->estado}")
            ->action('Ver Pedido', url("/pedidos/{$this->pedido->id}"))
            ->line('Gracias por confiar en nuestro servicio.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'pedido_id' => $this->pedido->id,
            'estado' => $this->pedido->estado,
        ];
    }
}