<?php
/*ECash_API_Lead
 * 
 * Used to feed an OLP data structure and make the intial insert into LDB for a lead
 * 
 * 
 */

class ECash_API_Lead
{
	protected $insert_api;
	protected $user_pass;
	protected $data;
	
	const EVENT_BEGIN = 'APPLICATION';
	const EVENT_END = 'ACCEPT';
	const EVENT_QUALIFY = "QUALIFY";
	/**
	 * The constructor is where any name_short to id conversions should take place
	 * and any other prep work along those lines
	 * 
	 * @param array $data array with format:
	 *  $data = array(
	 * 				  'application' => array(
                                            'date_modified' 		=> time(),
                                            'date_created'  		=> time(),
                                            'company_id'            => 'mls',
                                            'application_id'  		=> '900095654',
                                            'track_id'              => '654asdf654asdf654sda65f4',
                                            'modifying_agent_id'    => 'olp',
                                            'agent_id'      		=> 'olp',
                                            'application_status_id' => 'queued::verification::applicant::*root',
                                            'is_react'              => 'no',
                                            'application_type' 		=> 'paperless',
                                            'ip_address'            => '192.0.123.321',
                                            'bank_name'             => 'Test Bank',
                                            'bank_aba'              => '456321654',
                                            'bank_account'          => '987654',
                                            'bank_account_type'     => 'checking',
                                            'date_fund_estimated'   => strtotime('2008-05-13'),
                                            'date_first_payment'    => strtotime('2008-06-02'),
                                            'fund_qualified'        => 300,
                                            'finance_charge'        => 90,
                                            'payment_total'         => 390,
                                            'apr'                   => 891.32,
                                            'income_monthly'        => 2600,
                                            'income_source'         => 'employment',
                                            'income_direct_deposit' => 'yes', 
                                            'income_frequency'      => 'weekly',
                                            'paydate_model'         => 'dw',
                                            'day_of_week'           => 'mon',
                                            'legal_id_type'         => 'dl',
                                            'legal_id_number'       => '654321',
                                            'legal_id_state'        => 'oh',
                                            'email'                 => 'testemail@sellingsource.com',
                                            'name_last'             => 'blahtsstest',
                                            'name_first'            => 'blahtsstest',
                                            'name_middle'           => 'boo',
                                            'dob'                   => strtotime('1985-05-13'),
                                            'ssn'                   => '456883215',
                                            'street'                => 'test street',
                                            'unit'                  => '',
                                            'city'                  => 'columbus',
                                            'state'                 => 'oh',
                                            'zip_code'              => '43085',
                                            'phone_home'            => '6549872356',
                                            'phone_cell'            => '6549873652',
                                            'phone_fax'             => '',
                                            'call_time_pref'        => 'evening',
                                            'employer_name'         => 'fun co',
                                            'date_hire'             => strtotime('2008-01-05'),
                                            'phone_work'            => '6549872356',
                                            'phone_work_ext'        => null

                                             ),
                        'site' 			=> array (
                                        	     'name' => 'multiloansource.net',
                                            	 'license_key' => 'c0727854adaca409e00a7384e4ad7c5c'

                                            ),
                        'campaign' 		=> array (
                                             	'promo_id' =>'1000', 
                                             	'sub_code' => '', 
                                             	'reservation' => ''
                                            ),
                        'statushistory' => array(
                                                 0 => array (
                               				                  'date' => time(),
                                                              'status_string' => 'confirmed::prospect::*root'
                                            	               ),
                                            	 1 => array (
                                                              'date' => time(),
                                                              'status_string' => 'agree::prospect::*root'
                                                             )
                                                  ),
                        'reference' 	=> array (
                                                 0 => array (
                                                              'name' => 'Testus brotha', 
                                                              'phone' => '6549872587', 
                                                              'relationship' => 'brother'
                                                	           ),
                                                 1 => array (
                                                              'name' => 'Testus motha', 
                                                              'phone' => '6549872387', 
                                                              'relationship' => 'mother'
                                                    	        )

                                     	        ),
                        'bureau_inquiry' => array(
                                        	     0 => array (
                                                              'type' => 'aalm-perf', 
                                                              'sent' => '', 
                                                              'received' => '', 
                                                              'trace' => '65465dsfg54654sdf', 
                                                              'outcome' => ''
                                            	                 ),
                        	                     1 => array (
                                                              'type' => 'aalm-perf', 
                                                              'sent' => '', 
                                                              'received' => '', 
                                                              'trace' => '65465dsfg54654sdf', 
                                                              'outcome' => ''
                                                	              )
                                                 ),
                        'comment' 		=> array (
                                               	 0 => array (
                                                              'comment_text' => 'test1',
                                                              'type' => 'standard', 
                                                              'source' => 'loan agent', 
                                                              'visibility' => 'public'
                                                            	 ),
                                                 1 => array (
                                                               'comment_text' => 'test2', 
                                                               'type' => 'standard', 
                                                               'source' => 'loan agent', 
                                                               'visibility' => 'public'
                                                   	   		      )
                                                 ),
                        'loanaction' 	=> array (
                                                 0 => array (
                                                               'name_short' => 'TT_OPEN_LOAN'
                                                 		         ),
                                                 1 => array (
                                                            	'name_short' => 'TT_RECENT_INQUIRIES'
                                                        		)
                                               	),
                        'flag' 			=> array (
                                                 0 => array (
                                                		         'name_short' => 'ach_email'
                                                       	         ),
                                                 1 => array (
                                                	              'name_short' => 'ty_email'
                                                    	  	        )
                                              	 ),

             		);

	 */
	public function __construct(array $data) 
	{
		$this->data = $data;
	}
	/**
	 * Creates and loads the ECash_API_Insertion object
	 */
	protected function load()
	{
		try {
						
			$this->insert_api = new ECash_API_Insertion($this->data['application']);
			$this->insert_api->addSite($this->data['site']['name'], $this->data['site']['license_key']);
			$this->insert_api->addCampaign($this->data['campaign']['promo_id'], $this->data['campaign']['sub_code'], $this->data['campaign']['reservation']); 
			$this->user_pass = $this->insert_api->addCustomer();
			
			if(!empty($this->data['statushistory']))
			{
				foreach($this->data['statushistory'] as $history_entry)
				{
					$this->insert_api->addStatusHistory($history_entry['date'], $history_entry['status_string']); 
				}
			}
			
			if(!empty($this->data['reference']))
			{
				foreach($this->data['reference'] as $reference_entry)
				{
					$this->insert_api->addReference($reference_entry['name'], $reference_entry['phone'], $reference_entry['relationship']); 
				}
			}
			
			if(!empty($this->data['bureau_inquiry']))
			{
				foreach($this->data['bureau_inquiry'] as $inquiry_entry)
				{
					$this->insert_api->addInquiry($inquiry_entry['type'], $inquiry_entry['sent'], $inquiry_entry['received'], $inquiry_entry['trace'], $inquiry_entry['outcome']);
				}
			}
			
			if(!empty($this->data['comment']))
			{
				foreach($this->data['comment'] as $comment_entry)
				{
					$this->insert_api->addComment($comment_entry['comment_text'], $comment_entry['type'], $comment_entry['source'], $comment_entry['visibility']);
				}
			}
			if(!empty($this->data['loanaction']))
			{
				foreach($this->data['loanaction'] as $loanaction_entry)
				{
					$this->insert_api->addLoanAction($loanaction_entry['name_short']); 
				}
			}
			
			if(!empty($this->data['flag']))
			{
				foreach($this->data['flag'] as $flag_entry)
				{
					$this->insert_api->setFlag($flag_entry['name_short']);
				}
			}
		}
		catch(Exception $e)
		{
			throw $e;
		}
	}
	/**
	 * Resolves the company name_short given to a company_id if needed
	 */
	protected function get_company_id()
	{
		if(!is_numeric($this->data['application']['company_id']))
		{
				$company = ECash::getFactory()->getModel('Company');
				$company->loadBy(array('name_short' => $this->data['application']['company_id']));
				if(empty($company->company_id))
				{
					throw exception('Invalid Company');
				}
				else
				{
					return $company->company_id;
				}
		}
		else
		{
			return $this->data['application']['company_id'];
		}
		
	}
	/**
	 * Runs the cfe rules for determining the correct cfe rule set to use
	 */
	protected function get_cfe_rule_set()
	{
		$db = ECash::getMasterDb();
		$factory = new ECash_CFE_RulesetFactory($db);
		$company_id = $this->get_company_id();
		$rules = new ECash_CFE_AsynchRuleDecorator(
					$factory->fetchEvent(self::EVENT_BEGIN, $company_id),
					$db
					);
		

		// can't use the model context here because
		// we don't actually have an application ID yet
		$context = new ECash_CFE_ArrayContext($this->data['application']);

		$engine = ECash_CFE_Engine::getInstance($context);
		$engine->setRuleset(array(self::EVENT_BEGIN => array($rules)));

		// execute the rules and return the set attributes
		$this->attr = $engine->executeEvent(self::EVENT_BEGIN);
					
		$this->cfe_ruleset_id = $rules->getRulesetId();

		return $this->cfe_ruleset_id;

	}
	/**
	 * Runs the associated cfe rules for acceptance of an application
	 * 
	 * @param int $application_id
	 */
	protected function run_cfe($application_id)
	{
		$db = ECash::getMasterDb();
		$factory = new ECash_CFE_RulesetFactory($db);
		$rules = $factory->fetchRuleset($this->cfe_ruleset_id);
		$application = ECash::getFactory()->getModel('Application');
		$application->loadBy(array('application_id' => $application_id));
		
		$context = new ECash_CFE_DefaultContext($application, $db);
	
		foreach ($this->attr as $name=>$value)
		{
			$context->setAttribute($name, $value);
		}

		$engine = ECash_CFE_Engine::getInstance($context);
		$engine->setRuleset($rules);

		return $engine->executeEvent(self::EVENT_END);
	}
	/**
	 * Retrieves the current loan type id for the cfe rule set
	 *  
	 * @param int $rule_set_id
	 * 
	 * @return int loan_type_id
	 */
	protected function getLoanTypebyCFE($rule_set_id)
	{
		$cfe_rules = ECash::getFactory()->getModel('CfeRuleSet');
		$cfe_rules->loadBy(array('cfe_rule_set_id' => $rule_set_id));
		
		if(empty($cfe_rules->loan_type_id))
		{
			return false;
		}
		else
		{
			return $cfe_rules->loan_type_id;
		}
	}
	/**
	 * Retrieves the current business rule set id for the loan type
	 * 
	 * @param int $loan_type
	 * 
	 * @return int rule_set_id
	 */
	protected function getCurrentBusinessRuleByLoanType($loan_type)
	{
		$rules = ECash::getFactory()->getModel('RuleSet');
		$row = $rules->getActiveByLoanType($loan_type);
		
		if(empty($row->rule_set_id))
		{
			return false;
		}
		else
		{
			return $row->rule_set_id;

		}

	}
	/** 
	 * Run the various steps of creating and saving the lead
	 * 
	 * @returns an array of customer info array(login => '', password => '' application_id => '')
	 * @returns false if lead is not accepted
	 */
	public function save()
	{
		try {
			
			$rule_set_id = $this->get_cfe_rule_set();
			if(!is_numeric($rule_set_id))
			{
				return false;
			}
			$loan_type_id = $this->getLoanTypebyCFE($rule_set_id);
			if(!is_numeric($loan_type_id))
			{
				return false;
			}
			$business_rule_set = $this->getCurrentBusinessRuleByLoanType($loan_type_id);
			if(!is_numeric($business_rule_set))
			{
				return false;
			}
			$this->data['application']['rule_set_id'] = $business_rule_set;
			$this->data['application']['cfe_rule_set_id'] = $rule_set_id;
			$this->data['application']['loan_type_id'] = $loan_type_id;
			
			$this->load();
			$this->user_pass['application_id'] = $this->insert_api->save();
			$this->run_cfe($this->user_pass['application_id']);
		}
		catch(Exception $e)
		{
			throw $e;
		}
		return $this->user_pass;
		
	}

}


?>
