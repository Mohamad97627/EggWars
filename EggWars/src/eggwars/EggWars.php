<?php

declare(strict_types=1);

namespace eggwars;

use eggwars\commands\EggWarsCommand;
use pocketmine\plugin\PluginBase;

/**
 * Class EggWars
 * @package eggwars
 */
class EggWars extends PluginBase {

    /**
     * @var EggWars $instance
     */
    private static $instance;

    /**
     * @var ArenaManager $arenaManager
     */
    private $arenaManager;

    /**
     * @var SetupManager $setupManager
     */
    private $setupManager;

    public function onEnable() {
        self::$instance = $this;
        $this->registerCommands();
        $this->arenaManager = new ArenaManager;
        $this->setupManager = new SetupManager;
        $this->getLogger()->notice("You are running dev version of EggWars");
        $this->loadTestArena();
    }

    private function loadTestArena() {
        $this->getArenaManager()->createArena("TestArena");
    }

    public function onDisable() {
        $this->arenaManager->saveArenas();
    }

    private function registerCommands() {
        $this->getServer()->getCommandMap()->register("eggwars", new EggWarsCommand);
    }

    /**
     * @return ArenaManager $arenaManager
     */
    public function getArenaManager():ArenaManager {
        return $this->arenaManager;
    }

    /**
     * @return string $prefix
     */
    public static function getPrefix(): string {
        return "§3[EggWars] ";
    }

    /**
     * @return EggWars $plugin
     */
    public static function getInstance(): EggWars {
        return self::$instance;
    }
}
