<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->categories();
    }

    private function categories() {
        $categories_quest = array(
            'Experience' => $this->experience_quest(),
            'Sustainability' => $this->sustainability_quest(),
            'Data & AI' => $this->data_ai_quest(),
            'Fraud and Security' => $this->fraud_security_quest(),
            'Risk and Compliance' => $this->risk_compliance_quest(),
            'Cloud and Core' => $this->cloud_core_quest(),
            'Talent' => $this->talent_quest(),
            'Banking' => $this->banking_quest(),
        );
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Question::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        foreach($categories_quest as $key => $category) {
            $cat_data = array(
                'name' => $key,
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );
            $create = Category::create($cat_data);
            $lastId = $create->id;
            $questions = array();
            foreach($category as $cat) {
                $temp = $cat;
                $temp['cat_id'] = $lastId;
                $questions[] = $temp;
            }
            Question::insert($questions);
        }
    }

    private function experience_quest() {
        return array(
            array(
                'name' => '_______ brings new features and enhancements to accelerate delivery of edge intelligence, delightful customer experience and robust industry solutions on the platform.',
                'status' => 'active',
                'option1' => 'Accenture Adaptive Platform',
                'option2' => 'Accenture IKE',
                'answer' => 'Accenture Adaptive Platform',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'ACN Experience Builder helps reimagine or rearchitect ___________ and to rapidly develop solutions that have built-in industry experience and consider their environment and changing context of use.',
                'status' => 'active',
                'option1' => 'customer journeys, business processes',
                'option2' => 'operational and technical processes',
                'answer' => 'customer journeys, business processes',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'ACN Experience Builder provides client hyper-relevant customer journey',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which of these are one of the components of Digital experience Framework',
                'status' => 'active',
                'option1' => 'Sentiment',
                'option2' => 'Sustainability',
                'answer' => 'Sentiment',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'In many ways, BX is the inevitable consequence of the fact that we had been defining the domain of customer centricity too narrowly as a set of touch points over the past 20 years.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Empowering employees to feel accountable for customer outcomes is a way in which BX comes to life',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Almost 60% of leaders said they were very confident about their ability to link their CX innovations to actual business results',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False (80%)',
                'answer' => 'False (80%)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Leaders are more than____ as likely to have a strong ability to infuse customer experience thinking across their organization and their partners at all levels.',
                'status' => 'active',
                'option1' => '2x',
                'option2' => '5x',
                'answer' => '2x',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'On average, top ____ are more likely to outperform their _______',
                'status' => 'active',
                'option1' => 'BX companies, CX-oriented companies',
                'option2' => 'CX-oriented companies, BX companies',
                'answer' => 'BX companies, CX-oriented companies',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '77% of CEOs said their company will fundamentally change the way it engages and interacts with its __________.',
                'status' => 'active',
                'option1' => 'Customers',
                'option2' => 'stakeholders',
                'answer' => 'Customers',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'The Accenture asset that is powered by AI for customer engagement.',
                'status' => 'active',
                'option1' => 'ACE +',
                'option2' => 'Flybits',
                'answer' => 'ACE +',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
          
            array(
                'name' => 'On average, BX leaders outperform CX-oriented companies in year-on-year profitability growth* by ____',
                'status' => 'active',
                'option1' => '6.3x in 7 years',
                'option2' => '7.2x in 7 years',
                'answer' => '6.3x in 7 years',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Delivery models, employee experience, products and services, innovation, purpose and value are the pillars of __________',
                'status' => 'active',
                'option1' => 'CX',
                'option2' => 'BX',
                'answer' => 'BX',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Acceleration from CX to BX is the result of _________',
                'status' => 'active',
                'option1' => 'Global Pandemic(COVID-19)',
                'option2' => 'Growing Market competition',
                'answer' => 'Global Pandemic(COVID-19)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture is partnering with _______ to reimagine human experiences that reignite growth and accelerate the path to value.',
                'status' => 'active',
                'option1' => 'Salesforce',
                'option2' => 'Microsoft',
                'answer' => 'Salesforce',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
    }
    private function sustainability_quest() {
        return array(
            array(
                'name' => 'We have made sustainability one of our greatest responsibilities—not just because it’s the right thing to do, but also because we believe that it is one of the most powerful forces for change in our generation',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'As per the study, ____% Say ‘lack of knowledge’ is a barrier which keep them from implementing a strategic company wide approach to sustainability',
                'status' => 'active',
                'option1' => '40%',
                'option2' => '23% ',
                'answer' => '40%',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'In fiscal 2021, we promoted 120,000 people and invested US$900 million in training, which includes learning opportunities in technology skills and topics such as Artificial Intelligence.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture has achieved our goal of 25% women managing directors and set a new goal of ____ in Gender Equality',
                'status' => 'active',
                'option1' => '30%',
                'option2' => '45%',
                'answer' => '30%',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which partner did Accenture tie-up with to plant 674,000 trees',
                'status' => 'active',
                'option1' => 'One tree planted',
                'option2' => 'Treedom',
                'answer' => 'One tree planted',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Sustainable lending has skyrocketed from $5 billion in 2017 to $120bn in 2020',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'In 2021, ________ surged by 300% which is more than $700bn',
                'status' => 'active',
                'option1' => 'sustainable lending',
                'option2' => 'sustainable investment ',
                'answer' => 'sustainable lending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
         
            array(
                'name' => 'The Climate Risk impact tool helps us evaluate the impact of climate change on property value in a selected area?',
                'status' => 'active',
                'option1' => 'ACARA',
                'option2' => 'myNav',
                'answer' => 'ACARA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Partnering with Gavi, the Vaccine Alliance to improve supply chain forecasting and optimize the rollout of _____ vaccines worldwide.',
                'status' => 'active',
                'option1' => 'COVID-19',
                'option2' => 'Polio',
                'answer' => 'COVID-19',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which is one of the key features of the Capital Markets, ESG.AI for Investment management?',
                'status' => 'active',
                'option1' => 'Topic Modeling',
                'option2' => 'Spend Analysis',
                'answer' => 'Topic Modeling',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'From wheelchair-mounted robotic arms to developing a non-binary voice assistant, Accenture’s ______ initiative uses technology to address critical challenges and drive sustainable, social change.',
                'status' => 'active',
                'option1' => 'Tech4Good',
                'option2' => 'Skills2Succeed',
                'answer' => 'Tech4Good',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'ESG Maturity Assessment Modeling: Evaluation of client’s maturity on capabilities to drive environmental and societal responsibility, and drive sustainable innovation',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture was ranked as ____ in Fortune Worlds most admired companies, marking 20 years of inclusion.',
                'status' => 'active',
                'option1' => '33',
                'option2' => '15',
                'answer' => '33',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture partnered with _____, to create the S-Ray offering which provides ESG bespoke solutions.',
                'status' => 'active',
                'option1' => 'Arabesque',
                'option2' => 'Advania',
                'answer' => 'Arabesque',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which among these is a discretionary external disclosures and reporting frameworks under ESG Disclosures.',
                'status' => 'active',
                'option1' => 'TCFD',
                'option2' => 'LOAM',
                'answer' => 'TCFD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture in the Czech Republic scored in the national LGBT+ equality awards and received a silver certificate as an LGBT+ Friendly Employer 2022.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '_____________ accelerator is designed to aid advisors in constructing and rebalancing an ESG portfolio without compromising on the risk-return trade-off',
                'status' => 'active',
                'option1' => 'Accenture Sustainable Investing',
                'option2' => 'Accenture Sustainable Lending',
                'answer' => 'Accenture Sustainable Investing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Green Software is the biggest driver to achieve sustainability in technology?',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
           
            array(
                'name' => '___________application to redefine traditional loyalty programs by making them sustainable, circular, and mutually incentivizing for consumers, brands, and environment',
                'status' => 'active',
                'option1' => 'Gamified loyalty',
                'option2' => 'More than 9.99 out of 10',
                'answer' => 'Accenture Sustainable Investing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '____________ is a AI Based Solution Framework for treasury to optimize ESG aligned High Quality Collateral',
                'status' => 'active',
                'option1' => 'Green Collateral',
                'option2' => 'Accenture Sustainable Investing',
                'answer' => 'Green Collateral',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
    }
    private function data_ai_quest() {
        return array(
            array(
                'name' => 'Which asset/platform belongs to the pillar Architect and Build the modern data platform',
                'status' => 'active',
                'option1' => 'Accenture MyNav',
                'option2' => 'Voyager',
                'answer' => 'Accenture MyNav',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture brings the fusion of Industry depth, data & AI expertise, and reusable innovation of the cloud ecosystem to unearth business value of data',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '_______ is the only place where data gains agility, scale and the power to drive reinvention, so business can soar.',
                'status' => 'active',
                'option1' => 'Cloud',
                'option2' => 'On-Prem',
                'answer' => 'Cloud',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What makes data foundation Modern?',
                'status' => 'active',
                'option1' => 'AI assisted data governance',
                'option2' => 'Siloed platforms',
                'answer' => 'AI assisted data governance',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Responsible AI is the practice of using AI with good intention to empower employees, businesses, fairly impact customers and society – allowing companies to engender trust and scale AI with confidence',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which of these is one of the primary ecosystem partners of Accenture Europe to deliver data effective operations',
                'status' => 'active',
                'option1' => 'Genesys',
                'option2' => 'TIBC',
                'answer' => 'Genesys',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which of these is one of the primary ecosystem partners of Accenture Europe to deliver Infrastructure database management',
                'status' => 'active',
                'option1' => 'MongoDB',
                'option2' => 'IBM DB2',
                'answer' => 'MongoDB',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'For AI to scale, it must earn human ______',
                'status' => 'active',
                'option1' => 'Trust',
                'option2' => 'Knowledge',
                'answer' => 'Trust',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which of these are part of the Responsible AI pillars?',
                'status' => 'active',
                'option1' => 'Reskill',
                'option2' => 'Diversity ',
                'answer' => 'Reskill',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Data democratization does not involve information access, data sharing, AI models and BI systems.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Data curation involves Standardization, cleansing and ________ of data sets into more usable assets',
                'status' => 'active',
                'option1' => 'Integration',
                'option2' => 'Encryption',
                'answer' => 'Integration',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'According to Accenture study, 84% of the market value of S&P 500 companies that comes from intangible assets, including data and software',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'According to Accenture survey of 190 executives in the US, nearly 48% of banking, capital markets and insurance companies lack an enterprise data strategy to fully capitalize on their data assets',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'False(82%)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'To help CEOs move from stated intention to activating data transformation, Accenture has created a prescriptive approach for creating and deploying ______',
                'status' => 'active',
                'option1' => 'Data capital',
                'option2' => 'Dev-ops',
                'answer' => 'Data capital',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Not all data requires the same control and oversight, so Accenture approaches implementation by tiering the data into levels of ?',
                'status' => 'active',
                'option1' => 'Governance and care',
                'option2' => 'Speed and Automation',
                'answer' => 'Governance and care',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '_________ applies the data sharing principles pioneered through Open Banking & Open Finance to all financial and non-financial customer data facilitating a truly ‘Open Economy’',
                'status' => 'active',
                'option1' => 'Open Data',
                'option2' => 'Data Capital',
                'answer' => 'Open Data',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '__________ is a cloud-based solution which scans through data sources and searches for information on the entity based on a list of keywords.',
                'status' => 'active',
                'option1' => 'Snooper',
                'option2' => 'Collection App',
                'answer' => 'Snooper',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        array(
            'name' => 'What does Accenture’s TQ stands for',
            'status' => 'active',
            'option1' => 'Talent Quotient',
            'option2' => 'Talent Quality',
            'answer' => 'Talent Quotient',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ),
        array(
            'name' => 'What does Accenture’s TQ stands for',
            'status' => 'active',
            'option1' => 'Talent Quotient',
            'option2' => 'Talent Quality',
            'answer' => 'Talent Quotient',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ),
        array(
            'name' => 'What does Accenture’s TQ stands for',
            'status' => 'active',
            'option1' => 'Talent Quotient',
            'option2' => 'Talent Quality',
            'answer' => 'Talent Quotient',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        )
          
        );
    }
    private function fraud_security_quest() {
        return array(
            array(
                'name' => 'Which among these are one of the financial Service Security & resilience domains serviced by Accenture',
                'status' => 'active',
                'option1' => 'Cyber defense services',
                'option2' => 'Strategy and Risk',
                'answer' => 'Cyber defense services',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture Security is world’s first 5g Telecom networks in Japan and Europe',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture security records _____ security events ingested/day',
                'status' => 'active',
                'option1' => '260 million',
                'option2' => '100 million',
                'answer' => '260 million',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'As per Accenture research, 3.3% of world trade is counterfeit/pirated goods.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which among these are one of the Accenture 2022 Fraud Themes',
                'status' => 'active',
                'option1' => 'AI Legislation',
                'option2' => 'Staff & Company policy',
                'answer' => 'AI Legislation',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture has 25+ technology partner integration into its FinCrime Ecosystem',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Investment has shifted from siloed point detection solutions to the fraud architecture in order to _________',
                'status' => 'active',
                'option1' => 'Shift to human centered interventions',
                'option2' => '120',
                'answer' => 'Shift to human centered interventions',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Interfaces and handoffs is one of the Components of Fraud Management',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture is uniquely positioned to support financial institutions in their Fraud Management journey through _________ framework',
                'status' => 'active',
                'option1' => 'Strategic fraud capability',
                'option2' => 'Strategic delivery',
                'answer' => 'Strategic fraud capability',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture’s analytics center of excellence for financial crime is in ________',
                'status' => 'active',
                'option1' => 'Dublin',
                'option2' => 'Bangalore',
                'answer' => 'Dublin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture’s __________ can manage over 200 projects, coordinating multiple changes in parallel',
                'status' => 'active',
                'option1' => 'Design Authority',
                'option2' => 'Benefits Modelling',
                'answer' => 'Design Authority',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture Operation’s FaaS stands for ?',
                'status' => 'active',
                'option1' => 'Fraud as a Services',
                'option2' => '⦁	Fraud Analytics Architecture services ',
                'answer' => 'Fraud as a Services',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Who is the global lead for Accenture FS Security?',
                'status' => 'active',
                'option1' => 'Chris Thompson',
                'option2' => 'Kelly Bissell',
                'answer' => 'Chris Thompson',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Number of cyber attacks that breach security in the category of Cyber champions is 1 in 2',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False(1 in 16)',
                'answer' => 'False(1 in 16)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Cyber Risk Takers take a business-first approach and place less emphasis on alignment with the cybersecurity strategy.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
    }
    private function risk_compliance_quest() {
        return array(
            array(
                'name' => 'BIGID is Accenture’s cyber risk ecosystem partner',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '__________ is a Global Product category leader in Banking for Enterprise Financial Crime Management',
                'status' => 'active',
                'option1' => 'Clari5',
                'option2' => 'Snooper',
                'answer' => 'Clari5',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Digital Reporting is one of the key pillars of Accenture Lending Risk Management framework',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture is recognized as a Leader in Everest Group’s Financial Crime & Compliance Operations Services PEAK MatrixTM',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '____ Artificial Intelligence to optimize alerts management, respecting the 4-eyes principle',
                'status' => 'active',
                'option1' => '86%',
                'option2' => '60%',
                'answer' => '86%',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Intelligent workforce foundation will be one among the key usecases for Accenture’s FS Risk & Compliance.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '_______ is the Accenture Tool with a full range of Anti-Financial crime services.',
                'status' => 'active',
                'option1' => 'AMLET -AML',
                'option2' => 'snooper',
                'answer' => 'AMLET -AML',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Less than ______% are very satisfied with their business progress in proactively identifying new risks',
                'status' => 'active',
                'option1' => '30%',
                'option2' => '50%',
                'answer' => '30%',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Future risk management will exploit synergies across domains, be real-time, forward looking, efficient, flexible and support ‘_________’',
                'status' => 'active',
                'option1' => 'segments of one',
                'option2' => 'value delivery',
                'answer' => 'segments of one',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
           
            array(
                'name' => 'The effort mix of high-value SME functions and repetitive, operational tasks has traditionally been split ~______ basis across the industry.',
                'status' => 'active',
                'option1' => '20:80',
                'option2' => '30:70',
                'answer' => '20:80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Risk practitioners of the future will need to have _____ skill',
                'status' => 'active',
                'option1' => 'Analyze and Advice',
                'option2' => 'Manual spreadsheet knowledge',
                'answer' => 'Analyze and Advice',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Is it true that “One size fits all” migration approach in Risk domain',
                'status' => 'active',
                'option1' => 'Yes',
                'option2' => 'No',
                'answer' => 'Yes',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'A comprehensive, ________ environment will need to support both the legacy and target environments for many of the risk functions',
                'status' => 'active',
                'option1' => 'real-time data',
                'option2' => 'real-time data',
                'answer' => 'static data',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '______ should be a priority given the correlation between deploying _____ and progress on embracing agility, reducing the cost of risk and identifying new risks',
                'status' => 'active',
                'option1' => 'Cloud & Cloud',
                'option2' => 'Sustainability & Cloud',
                'answer' => 'Cloud & Cloud',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture’s _____ has data capabilities with intelligent tools can help collect, validate & analyze ESG data and ensure you turn data to insights to actions',
                'status' => 'active',
                'option1' => 'Risk Management Framework',
                'option2' => 'Strategic delivery Framework',
                'answer' => 'Risk Management Framework',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
            );
    }
    private function cloud_core_quest() {
        return array(
            array(
                'name' => 'One of the key assets within Accenture to drive core to cloud transformation is ____',
                'status' => 'active',
                'option1' => 'myNav',
                'option2' => 'myWizard',
                'answer' => 'myNav',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'myNav delivers tangible benefits upto 40% of additional carbon emissions savings over typical migration',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False ',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'myNav supports transformation from ______ using a pragmatic approach that simplifies complexity',
                'status' => 'active',
                'option1' => 'insights to action',
                'option2' => 'strategy to insights',
                'answer' => 'insights to action',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Green cloud advisor is one of the key capabilities of myNav',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False ',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Who is the lead of Accenture Cloud First capability?',
                'status' => 'active',
                'option1' => 'Karthik Narain',
                'option2' => 'Pat Sullivan',
                'answer' => 'Karthik Narain',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture’s approach breaks down a complex cloud journey into three simple steps for faster value: ______, Accelerate, Growth and Innovate (MAGI)',
                'status' => 'active',
                'option1' => 'Migrate',
                'option2' => 'Mitigate',
                'answer' => 'Migrate',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Continuum competitors are more likely to use cloud for at least two sustainability goals.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False ',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Top pain-points of cloud adoption ______ sovereignty concerns / regulations',
                'status' => 'active',
                'option1' => 'Data',
                'option2' => 'Security',
                'answer' => 'Data',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which among these are keys to unlocking the potential of the Cloud Continuum',
                'status' => 'active',
                'option1' => 'Keep committing to strategy',
                'option2' => 'Scale awareness',
                'answer' => 'Keep committing to strategy',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Starbucks is one of the Cloud Continuum competitors',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False ',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Banks must accelerate their journey to net zero emissions by decarbonizing operations to meet the goals of Paris Climate Agreement & UN SDGs',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False ',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Google _____ is a dedicated mortgage solution on the cloud which can be customized to each lender',
                'status' => 'active',
                'option1' => 'LendingDocAI',
                'option2' => 'LoanDataExchange',
                'answer' => 'LendingDocAI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '_____ is Amazon’s Automatic Document Processing: to automatically extracts text, handwriting, and data from scanned documents for paperwork and
                Classify documents',
                'status' => 'active',
                'option1' => 'Amazon Rekognition',
                'option2' => 'Amazon Data Capture',
                'answer' => 'Amazon Rekognition',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which continuum competitor, has doubled its global production of N95 respirators to more than 1.1 billion per year.',
                'status' => 'active',
                'option1' => '3M',
                'option2' => 'Philips',
                'answer' => '3M',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '5G aides Cloud Continuum?',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False ',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
    }
    private function talent_quest() {
        return array(
            array(
                'name' => 'Accenture has more than ____ delivery centers across 5 continents, offering services in 39 languages',
                'status' => 'active',
                'option1' => '50',
                'option2' => '100',
                'answer' => '50',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '______ is one of the key assets under Accenture’s talent vertical.',
                'status' => 'active',
                'option1' => 'Transformation GPS',
                'option2' => '	Snooper',
                'answer' => 'Transformation GPS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture + __________ builds a clear path to finance transformation – the first step to unlocking value across your enterprise, and driving sustainable growth at pace and at scale.',
                'status' => 'active',
                'option1' => 'Workday',
                'option2' => 'Arabesque',
                'answer' => 'Workday',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture was recognized for 4 consecutive years under _____ Gender equality Index',
                'status' => 'active',
                'option1' => 'Bloomberg',
                'option2' => 'WallStreet Journal',
                'answer' => 'Bloomberg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture was recognized for ___ consecutive years for Seramount/ Working Mother 100 Best companies',
                'status' => 'active',
                'option1' => '19',
                'option2' => '25',
                'answer' => '19',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '____ number of HCM excellence award was won by Accenture in the year 2021',
                'status' => 'active',
                'option1' => '102',
                'option2' => '88',
                'answer' => '88',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'BEHAVIORAL SCIENCE TOOLKIT offers practitioners guidance on how to apply Behavioral Science (BSci) on projects, based on the latest research & case studies',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture has invested in an AI-driven Talent Lifecycle Management platform with AI-driven insights known as ______',
                'status' => 'active',
                'option1' => 'Beamery',
                'option2' => 'Pipeline',
                'answer' => 'Beamery',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '“________ is our single biggest risk, our single most critical potential point of failure with our technology transformations” - Paul Daugherty',
                'status' => 'active',
                'option1' => 'Talent',
                'option2' => 'Cloud',
                'answer' => 'Talent',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Fortune 500 CEO’s ranked talent shortages as the #1 threat to their business',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Cost of No Action ___ more expensive to hire skilled people compared to retaining and building those skills',
                'status' => 'active',
                'option1' => '6x',
                'option2' => '2x',
                'answer' => '6x',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Talent transformation is about accessing and creating the right skills, mindset, and behaviors to support the business ambition. ',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture is powered by _____ for rapid hiring and sourcing of high volume hourly and skilled talent .',
                'status' => 'active',
                'option1' => 'SynOps',
                'option2' => 'SkyHIve',
                'answer' => 'SynOps',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture’s ________ accelerates transformation and envisions the Future of Work with intelligence and human ingenuity.',
                'status' => 'active',
                'option1' => 'Change Management',
                'option2' => 'Curated Learning',
                'answer' => 'Change Management',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture creates _____-value for clients by building resilience to change and helping organizations become future-ready',
                'status' => 'active',
                'option1' => '360',
                'option2' => '180',
                'answer' => '360',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture ranked #1 in HFS Top 10 Employee Experience Services, 2022 for execution, innovation and alignment and ranked #2 for voice of the customer .',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture’s Future Talent Platform provides customized reskilling in a gamified user experience with social collaboration, available on-demand, anytime, anywhere, on any device. It delivers an integrated, seamless experience throughout the entire learning journey.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accenture extend’s our business capabilities through all these  powerful ecosystem of market leaders and innovators – arabesque / aws / eightfold.ai/Google/ Microsoft /Oracle/ SAP/Workday /Salesforce /cornerstone /skyhive/ servicenow',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
        );
    }
    private function banking_quest() {
        return array(
            array(
                'name' => 'RM Dashboard sustainability Offering helps embed Sustainability in ----------- Analysis',
                'status' => 'active',
                'option1' => 'Portfolio',
                'option2' => 'Spend',
                'answer' => 'Portfolio',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Accentures Banking myIndustry covers ---------- different offerings across various value chains',
                'status' => 'active',
                'option1' => '7',
                'option2' => '5 ',
                'answer' => 'Maximum two environments with no upgradation feature',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'myIndustry for Data-Driven Commercial Banking services integrates 7 banking platforms and more than 53 integration points, 24 assets and 29 accelerators. ',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '--------assets and accelerators targeting three business areas to help retail banking clients transform their business and drive better.',
                'status' => 'active',
                'option1' => '38',
                'option2' => '23',
                'answer' => '38',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Which asset under myIndustry helps support the Instant invisible and Free payments agenda?',
                'status' => 'active',
                'option1' => 'Frictionless Payments',
                'option2' => 'Payment’s command center',
                'answer' => 'Frictionless Payments',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '---------- Web based tool which facilitates underwriting &/ MI Underwriting & Post closing Package reviews to Mortgage Insurance or Lender Program Guidelines.',
                'status' => 'active',
                'option1' => 'Snooper',
                'option2' => 'A.Q.U.A',
                'answer' => 'Snooper',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Our Key partner for Enterprise Financial crime management ------------',
                'status' => 'active',
                'option1' => 'Clari5',
                'option2' => 'Fircosoft',
                'answer' => 'Fircosoft',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'An asset that helps in the customer discover process by integrating external ecosystem partners ------------',
                'status' => 'active',
                'option1' => 'Journey planner',
                'option2' => 'Gesture Based Banking',
                'answer' => 'Gesture Based Banking',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'EEG devices can be used only in medical studies and not for experience validation',
                'status' => 'active',
                'option1' => 'FALSE',
                'option2' => 'TRUE',
                'answer' => 'FALSE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'A Conversational AI Platform that delivers key enterprise capabilities for successful Virtual agent deployment is -----------------',
                'status' => 'active',
                'option1' => 'ACE+',
                'option2' => 'CoBI',
                'answer' => 'ACE+',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'myIndustry for Digital Bank in a Box Banking services integrates How many banking platforms',
                'status' => 'active',
                'option1' => '10',
                'option2' => '8',
                'answer' => '8',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => '---------- is the Regression test repository for all Market and regulatory requirements that augments the testing process in projects',
                'status' => 'active',
                'option1' => 'APTS',
                'option2' => 'APTP',
                'answer' => 'APTS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'LCR is A Data driven methodology to better predict cash flow and to face stricter Regulation on liquidity reporting resulting in Significant cost savings.',
                'status' => 'active',
                'option1' => 'True',
                'option2' => 'False ',
                'answer' => 'True',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'The Integration capsule integrates -------and LIQ for the syndicated loan origination journey and lays down the framework accelerating further integration.',
                'status' => 'active',
                'option1' => 'nCino',
                'option2' => 'SoFi',
                'answer' => 'nCino',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Payments command center provides a Real time view of transaction flow across all payment systems using which ecosystem Partner platform',
                'status' => 'active',
                'option1' => 'Finastra GPP',
                'option2' => 'Finastra GPP',
                'answer' => 'icon solutions',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),array(
                'name' => 'What does Accenture’s TQ stands for',
                'status' => 'active',
                'option1' => 'Talent Quotient',
                'option2' => 'Talent Quality',
                'answer' => 'Talent Quotient',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
    }
}
