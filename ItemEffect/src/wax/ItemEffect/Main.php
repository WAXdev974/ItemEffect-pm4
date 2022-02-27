<?php

namespace wax\ItemEffect;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    public function onEnable ()
    {
        $this->getServer()->PluginManager()->registerEvent(new EventListener(), $this);
        $this->getLogger()->info("le plugin a bien été Activé");
    }
}