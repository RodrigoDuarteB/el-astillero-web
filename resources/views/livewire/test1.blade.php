<div>
    <input type="text" wire:model='number'>
    <a href="https://api.whatsapp.com/send?phone=591{{ $number }}&text={{ $message }}" target="_blank" rel="noopener noreferrer">Enviar</a>
</div>
