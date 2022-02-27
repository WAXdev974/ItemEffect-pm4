<?php

namespace wax\ItemEffect;

use wax\ItemEffect\FormAPI\SimpleForm;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class eventListener implements Listener{
    /**
     * @var array
     */
    private $cooldown = [];
    public function menuSort(PlayerInteractEvent $e){
        $config = New Config(main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
        $player = $e->getPlayer();
        $i = $e->getItem();
        if ($i->getId() == 370){
            if ($player->isSneaking()){
                $this->sort1($player);
            }
            if (!$player->isSneaking()) {
                if ($config->get($player->getName()) === "vitesse") {
                    $lastutils = $this->cooldown[$player->getName()] ?? 0;
                    $timeNow = time();
                    if ($timeNow - $lastutils >= 15) {
                        $player->sendMessage("§c[§fMenu des sorts§c] §2> §1Vous avez utilisé votre Effect de speed, Haste");
                        $player->addEffect(new EffectInstance(Effect::getEffect(Effect::SPEED), 999999 * 999999, 10, false));
                        $player->addEffect(new EffectInstance(Effect::getEffect(Effect::HASTE), 999999 * 999999, 10, false));
                        $this->cooldown[$player->getName()] = $timeNow;
                    } else {
                        $player->sendPopup("§c[§fMenu des sorts§c] §2> §1Vous ne pouvez pas encore utiliser cette item, vous êtes à §2" . $timeNow - $lastutils . " §fsur §215 secondes");
                    }
                }
}