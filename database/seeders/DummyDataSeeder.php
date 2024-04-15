<?php

namespace Database\Seeders;

use App\Models\Leaderboard;
use App\Models\Player;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    private $carbon_date;
    private $faker;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date_lists = array(
            '2022-01-01 14:10:10',
            '2022-02-10 16:10:50',
            '2022-04-05 11:15:55',
            '2022-12-15 17:17:45',
            '2023-01-18 10:19:12',
            '2023-02-09 12:05:12',
            '2023-03-02 13:05:12',
            '2023-03-04 15:25:12',
            '2023-04-12 14:05:12',
            '2023-04-14 16:25:12',
            '2023-05-13 13:05:12',
            '2023-05-14 14:25:12',
            '2023-05-15 14:25:12',
            '2023-05-16 14:25:12',
            '2023-05-17 14:25:12',
            '2023-05-20 13:05:12',
            '2023-05-21 14:25:12',
            '2023-05-23 19:25:12',
            '2023-05-24 18:25:12',
            '2023-05-25 16:25:12',
        );
        foreach ($date_lists as $date) {
            $this->carbon_date = Carbon::createFromDate($date)->isoFormat('YYYY-MM-DD H:mm:ss');
            $this->update_players();
        }
    }

    private function update_players()
    {
        $session_id = time();
        $rand = rand(1, 8);
        $this->faker = Faker::create();
        $player_lists = array(
            array(
                'cat_id' => $rand,
                'session_id' => $session_id,
                'gaming_mode' => $this->faker->randomElement(['Display Mode', 'VR Mode']),
                'environment' => $this->faker->randomElement(['Garden By The Bay', 'Central Park']),
                'player_count' => 3,
                'name' => $this->faker->name(),
                'email' => $this->faker->companyEmail(),
                'organization' => $this->faker->company(),
                'age' => $this->faker->randomElement(['18-24', '25-34', '35-44', '45-54', '55-70']),
                'gender' => $this->faker->randomElement(['male', 'female', 'other']),
                'player_status' => 'active',
                'created_at' => $this->carbon_date,
                'updated_at' => $this->carbon_date,
            ),
            array(
                'cat_id' => $rand,
                'session_id' => $session_id,
                'gaming_mode' => $this->faker->randomElement(['Display Mode', 'VR Mode']),
                'environment' => $this->faker->randomElement(['Garden By The Bay', 'Central Park']),
                'player_count' => 3,
                'name' => $this->faker->name(),
                'email' => $this->faker->companyEmail(),
                'organization' => $this->faker->company(),
                'age' => $this->faker->randomElement(['18-24', '25-34', '35-44', '45-54', '55-70']),
                'gender' => $this->faker->randomElement(['male', 'female', 'other']),
                'player_status' => 'active',
                'created_at' => $this->carbon_date,
                'updated_at' => $this->carbon_date,
            ),
            array(
                'cat_id' => $rand,
                'session_id' => $session_id,
                'gaming_mode' => $this->faker->randomElement(['Display Mode', 'VR Mode']),
                'environment' => $this->faker->randomElement(['Garden By The Bay', 'Central Park']),
                'player_count' => 3,
                'name' => $this->faker->name(),
                'email' => $this->faker->companyEmail(),
                'organization' => $this->faker->company(),
                'age' => $this->faker->randomElement(['18-24', '25-34', '35-44', '45-54', '55-70']),
                'gender' => $this->faker->randomElement(['male', 'female', 'other']),
                'player_status' => 'active',
                'created_at' => $this->carbon_date,
                'updated_at' => $this->carbon_date,
            ),
        );
        foreach ($player_lists as $list) {
            $player = Player::create($list);
            $id = $player->id;
            $cat_id = $player->cat_id;
            $leaderboards = $this->leaderboard_data($id, $cat_id);
            $data = $this->profile_update();
            $player = Player::find($id);
            $player->calories = $data['calories'];
            $player->timer = $data['timer'];
            $player->timer_in_sec = $data['timer_in_sec'];
            $player->correct_answers = $leaderboards['is_correct'] ? $leaderboards['is_correct']: NULL;
            $player->save();
        }
    }

    private function leaderboard_data($player_id, $cat_id)
    {
        $questions = Question::inRandomOrder()->select('id')->where(array('cat_id' => $cat_id, 'status' => 'active'))->limit(10)->get();
        $data['is_correct'] = 0;
        $data['leaderboards'] = array();
        if ($questions->count() > 0) {
            foreach ($questions as $question) {
                $correct = $this->faker->randomElement(['yes', 'no', 'none']);
                if ($correct === 'yes') {
                    $data['is_correct']++;
                }
                $data['leaderboards'][] = array(
                    'player_id' => $player_id,
                    'question_id' => $question->id,
                    'is_correct' => $correct,
                    'created_at' => $this->carbon_date,
                    'updated_at' => $this->carbon_date
                );
            }
        }
        if ($data['leaderboards']) {
            $leaderboard = Leaderboard::where('player_id', $player_id)->first();
            if(!empty($leaderboard)) {
                Leaderboard::where('player_id', $player_id)->delete();
            }
            Leaderboard::insert($data['leaderboards']);
        }
        return $data;
    }

    private function profile_update()
    {
        $timer = $this->faker->randomElement(['00:10:10', '00:08:15', '00:06:12', '00:09:10', '00:05:00']);
        $timers_explode = explode(':', $timer);
        $seconds = ($timers_explode[0] * 60 * 60) + ($timers_explode[1] * 60) + $timers_explode[2];
        $data = array(
            'calories' => rand(100, 300),
            'timer' => $timer,
            'timer_in_sec' => $seconds
        );
        return $data;
    }
}
