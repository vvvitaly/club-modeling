<?php declare(strict_types=1);

namespace Club\Emulating;

use Club\Dances\Styles\DanceStyle;
use Club\Dances\Styles\ElectroDance;
use Club\Dances\Styles\HipHop;
use Club\Dances\Styles\House;
use Club\Dances\Styles\PopMusicDance;
use Club\Dances\Styles\Rnb;
use Club\Music\Composition;
use Club\Music\Genre;
use Club\Music\Playlist;
use Club\Persons\DanceStylesCollection;
use Club\Persons\Gender;
use Club\Persons\Person;
use Club\Persons\PersonId;
use Faker\Generator;

/**
 * Create configuration from PHP-array config of type:
 * [
 *   'musicTrackDurationSeconds' => <int value>,
 *   'playlist' => <tracks list> or <int>,
 *   'persons' => <person list> or <int>,
 * ],
 *
 * If some number specified for the 'playlist' and 'persons' keys, the random values will be generated
 * (using playlist factory and person factory).
 *
 * Tracks list has the following format:
 * [
 *   [
 *      'title' => <string> or 'random',
 *      'genre' => Genre or ['rnb'|'electro'|'pop'] or 'random',
 *   ]
 * ]
 *
 * Person list has the following format:
 * [
 *   [
 *     'name' => <string> or 'random',
 *     'gender' => Gender or ['male'|'female'] or 'random',
 *     'styles => <styles list> or <int - number of random styles (from 1 to 5)>
 *   ],
 * ]
 *
 * Styles list is array of elements: DanceStyle or ['electrodance'|'hip-hop'|'house'|'pop'|'rnb'] or 'random'
 */
final class ConfigurationFactory
{
    public const GENRE_RNB = 'rnb';
    public const GENRE_ELECTRO_HOUSE = 'electro';
    public const GENRE_POP_MUSIC = 'pop';

    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    public const STYLE_ELECTRO_DANCE = 'electrodance';
    public const STYLE_HIP_HOP = 'hip-hop';
    public const STYLE_HOUSE = 'house';
    public const STYLE_POP_MUSIC = 'pop';
    public const STYLE_RNB = 'rnb';

    /**
     * @var array
     */
    private $config;

    /**
     * @var Generator
     */
    private $faker;

    /**
     * @var Genre[]
     */
    private $genres;

    /**
     * @var Gender[]
     */
    private $genders;

    /**
     * @var DanceStyle[]
     */
    private $dances;

    /**
     * ConfigurationFactory constructor.
     *
     * @param array $config
     * @param Generator $faker
     */
    public function __construct(array $config, Generator $faker)
    {
        $this->config = $config;
        $this->faker = $faker;

        $this->genres = [
            self::GENRE_ELECTRO_HOUSE => Genre::electroHouse(),
            self::GENRE_RNB => Genre::rnb(),
            self::GENRE_POP_MUSIC => Genre::popMusic()
        ];
        $this->genders = [
            self::GENDER_MALE => Gender::male(),
            self::GENDER_FEMALE => Gender::female(),
        ];
        $this->dances = [
            self::STYLE_ELECTRO_DANCE => new ElectroDance(),
            self::STYLE_HIP_HOP => new HipHop(),
            self::STYLE_HOUSE => new House(),
            self::STYLE_POP_MUSIC => new PopMusicDance(),
            self::STYLE_RNB => new Rnb(),
        ];
    }

    /**
     * @return EmulatingConfiguration
     * @throws \InvalidArgumentException
     */
    public function createConfiguration(): EmulatingConfiguration
    {
        $configuration = new EmulatingConfiguration();

        $configuration->musicTrackDurationSeconds = $this->config['musicTrackDurationSeconds'] ?? 5;

        $playlist = $this->config['playlist'] ?? [];
        $configuration->playlist = is_array($playlist)
            ? $this->createPlaylist($playlist)
            : $this->generatePlaylist((int)$playlist);

        $persons = $this->config['persons'] ?? [];
        $configuration->initialVisitors = is_array($persons)
            ? $this->createPersons($persons)
            : $this->generatePersons((int)$persons);

        return $configuration;
    }

    /**
     * Create playlist from config
     *
     * @param array $playlistConfig
     *
     * @return Playlist
     * @throws \InvalidArgumentException
     */
    private function createPlaylist(array $playlistConfig): Playlist
    {
        $playlist = new Playlist();
        foreach ($playlistConfig as $compositionConfig) {
            $title = $compositionConfig['title'] ?? null;
            $genreConfig = $compositionConfig['genre'] ?? null;

            if ($title === 'random') {
                $title = $this->faker->sentence;
            }

            if ($title === null) {
                throw new \InvalidArgumentException("Title \"$title\" is invalid");
            }

            if ($genreConfig === 'random') {
                $genre = $this->faker->randomElement($this->genres);
            } elseif (!$genreConfig instanceof Genre) {
                $genre = $this->genres[$genreConfig] ?? null;
            } else {
                $genre = $genreConfig;
            }

            if ($genre === null) {
                $class = Genre::class;
                throw new \InvalidArgumentException(
                    "Genre {$genreConfig} is invalid: it must be \"{$class}\" instance or one of ['rnb'|'electro'|'pop'|'random']"
                );
            }

            $playlist->addComposition(new Composition($title, $genre));
        }

        return $playlist;
    }

    /**
     * Generate random playlist
     *
     * @param int $tracksCount
     *
     * @return Playlist
     * @throws \InvalidArgumentException
     */
    private function generatePlaylist(int $tracksCount): Playlist
    {
        $config = array_fill(0, $tracksCount, ['title' => 'random', 'genre' => 'random']);
        return $this->createPlaylist($config);
    }

    /**
     * Create persons list from config
     *
     * @param array $personsConfig
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    private function createPersons(array $personsConfig): array
    {
        $persons = [];
        foreach ($personsConfig as $personConfig) {
            $genderConfig = $personConfig['gender'] ?? null;
            $name = $personConfig['name'] ?? null;
            $dancesStyles = $personConfig['styles'] ?? [];

            if ($genderConfig === 'random') {
                $gender = $this->faker->randomElement($this->genders);
            } elseif (!$genderConfig instanceof Gender) {
                $gender = $this->genders[$genderConfig] ?? null;
            } else {
                $gender = $genderConfig;
            }

            if ($gender === null) {
                $class = Gender::class;
                throw new \InvalidArgumentException(
                    "Gender {$genderConfig} is invalid: it must be \"{$class}\" instance or one of ['male'|'female'|'random']"
                );
            }

            if ($name === 'random') {
                $name = $this->faker->firstName($gender->isMale() ? 'male' : 'female');
            }

            if ($dancesStyles === 'random') {
                $dancesStyles = $this->faker->numberBetween(0, count($this->dances));
            }

            $styles = is_array($dancesStyles)
                ? $this->normalizeStyles($dancesStyles)
                : $this->generateStyles((int)$dancesStyles);

            $persons[] = new Person(
                new PersonId($name),
                $gender,
                $styles
            );
        }

        return $persons;
    }

    /**
     * Normalize styles from config
     *
     * @param array $dancesStylesConfig
     *
     * @return DanceStylesCollection
     * @throws \InvalidArgumentException
     */
    private function normalizeStyles(array $dancesStylesConfig): DanceStylesCollection
    {
        $styles = new \SplObjectStorage();
        foreach ($dancesStylesConfig as $styleConfig) {
            if ($styleConfig === 'random') {
                $style = $this->faker->randomElement($this->dances);
            } elseif (!$styleConfig instanceof DanceStyle) {
                $style = $this->dances[$styleConfig] ?? null;
            } else {
                $style = $styleConfig;
            }

            if ($style === null) {
                $class = DanceStyle::class;
                throw new \InvalidArgumentException(
                    "Dance {$styleConfig} is invalid: it must be \"{$class}\" instance or one of ['electrodance'|'hip-hop'|'house'|'pop'|'rnb'|random']"
                );
            }

            $styles->attach($style);
        }

        return new DanceStylesCollection(...$styles);
    }

    /**
     * @param int $stylesCount
     *
     * @return DanceStylesCollection
     * @throws \InvalidArgumentException
     */
    private function generateStyles(int $stylesCount): DanceStylesCollection
    {
        $maxCount = count($this->dances);
        if ($stylesCount < 0 || $stylesCount > $maxCount) {
            throw new \InvalidArgumentException(
                "Styles count \"{$stylesCount}\" is invalid: it must be in interval [0; {$maxCount}]"
            );
        }
        $styles = $this->faker->randomElements($this->dances, $stylesCount);
        return new DanceStylesCollection(...$styles);
    }

    /**
     * Generate list of random persons
     *
     * @param int $personsCount
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    private function generatePersons(int $personsCount): array
    {
        $config = array_fill(
            0,
            $personsCount,
            ['name' => 'random', 'gender' => 'random', 'styles' => 'random']
        );
        return $this->createPersons($config);
    }
}