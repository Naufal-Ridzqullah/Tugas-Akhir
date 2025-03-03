#include <Fuzzy.h>

// Fuzzy
Fuzzy *fuzzy = new Fuzzy();

// FuzzyInputeEnergi
FuzzySet *rendah = new FuzzySet(0, 0, 5, 10);
FuzzySet *sedang = new FuzzySet(5, 10, 10, 15);
FuzzySet *tinggi = new FuzzySet(10, 15, 21.6, 21.6);

// FuzzyInputLuas
FuzzySet *kecil = new FuzzySet(0, 0, 50, 100);
FuzzySet *sedangg = new FuzzySet(35, 100, 100, 130);
FuzzySet *besar = new FuzzySet(100, 150, 220, 220);

// FuzzyOutputIKE
FuzzySet *efi = new FuzzySet(0, 0, 1.25, 3.05);
FuzzySet *efi1 = new FuzzySet(0, 0, 1.25, 3.05);
FuzzySet *efi2 = new FuzzySet(0, 0, 1.25, 3.05);
FuzzySet *efi3 = new FuzzySet(0, 0, 1.25, 3.05);
FuzzySet *ce = new FuzzySet(1.25, 3.05, 3.05, 5.34);
FuzzySet *ce1 = new FuzzySet(1.25, 3.05, 3.05, 5.34);
FuzzySet *ce2 = new FuzzySet(1.25, 3.05, 3.05, 5.34);
FuzzySet *te = new FuzzySet(4.05, 7, 10, 10);
FuzzySet *te1 = new FuzzySet(4.05, 7, 10, 10);


void setup() 
{
  Serial.begin(9600);
  // FuzzyInputEnergi
  FuzzyInput *energi = new FuzzyInput(1);

  energi->addFuzzySet(rendah);
  energi->addFuzzySet(sedang);
  energi->addFuzzySet(tinggi);
  fuzzy->addFuzzyInput(energi);

  // FuzzyInputLuas
  FuzzyInput *luas = new FuzzyInput(2);

  luas->addFuzzySet(kecil);
  luas->addFuzzySet(sedangg);
  luas->addFuzzySet(besar);
  fuzzy->addFuzzyInput(luas);

  // FuzzyOutputPotensiBanjir
  FuzzyOutput *ike = new FuzzyOutput(1);

  ike->addFuzzySet(efi);
  ike->addFuzzySet(efi1);
  ike->addFuzzySet(efi2);
  ike->addFuzzySet(efi3);
  ike->addFuzzySet(ce);
  ike->addFuzzySet(ce1);
  ike->addFuzzySet(ce2);
  ike->addFuzzySet(te);
  ike->addFuzzySet(te1);
  fuzzy->addFuzzyOutput(ike);

 // Building FuzzyRule1
  FuzzyRuleAntecedent *rendahAndkecil = new FuzzyRuleAntecedent();
  rendahAndkecil->joinWithAND(rendah, kecil);
  FuzzyRuleConsequent *thence = new FuzzyRuleConsequent();
  thence->addOutput(ce);
  FuzzyRule *fuzzyRule1 = new FuzzyRule(1, rendahAndkecil, thence);
  fuzzy->addFuzzyRule(fuzzyRule1);

  // Building FuzzyRule2
  FuzzyRuleAntecedent *rendahAndsedangg = new FuzzyRuleAntecedent();
  rendahAndsedangg->joinWithAND(rendah, sedangg);
  FuzzyRuleConsequent *thenefi = new FuzzyRuleConsequent();
  thenefi->addOutput(efi);
  FuzzyRule *fuzzyRule2 = new FuzzyRule(2, rendahAndsedangg, thenefi);
  fuzzy->addFuzzyRule(fuzzyRule2);

  // Building FuzzyRule3
  FuzzyRuleAntecedent *rendahAndbesar = new FuzzyRuleAntecedent();
  rendahAndbesar->joinWithAND(rendah, besar);
  FuzzyRuleConsequent *thenefi1 = new FuzzyRuleConsequent();
  thenefi1->addOutput(efi1);
  FuzzyRule *fuzzyRule3 = new FuzzyRule(3, rendahAndbesar, thenefi1);
  fuzzy->addFuzzyRule(fuzzyRule3);

  // Building FuzzyRule4
  FuzzyRuleAntecedent *sedangAndkecil = new FuzzyRuleAntecedent();
  sedangAndkecil->joinWithAND(sedang, kecil);
  FuzzyRuleConsequent *thenefi2 = new FuzzyRuleConsequent();
  thenefi2->addOutput(efi2);
  FuzzyRule *fuzzyRule4 = new FuzzyRule(4, sedangAndkecil, thenefi2);
  fuzzy->addFuzzyRule(fuzzyRule4);

  // Building FuzzyRule5
  FuzzyRuleAntecedent *sedangAndsedangg = new FuzzyRuleAntecedent();
  sedangAndsedangg->joinWithAND(sedang, sedangg);
  FuzzyRuleConsequent *thence1 = new FuzzyRuleConsequent();
  thence1->addOutput(ce1);
  FuzzyRule *fuzzyRule5 = new FuzzyRule(5, sedangAndsedangg, thence1);
  fuzzy->addFuzzyRule(fuzzyRule5);

  // Building FuzzyRule6
  FuzzyRuleAntecedent *sedangAndbesar = new FuzzyRuleAntecedent();
  sedangAndbesar->joinWithAND(sedang, besar);
  FuzzyRuleConsequent *thenefi3 = new FuzzyRuleConsequent();
  thenefi3->addOutput(efi3);
  FuzzyRule *fuzzyRule6 = new FuzzyRule(6, sedangAndbesar, thenefi3);
  fuzzy->addFuzzyRule(fuzzyRule6);

  // Building FuzzyRule7
  FuzzyRuleAntecedent *tinggiAndkecil = new FuzzyRuleAntecedent();
  tinggiAndkecil->joinWithAND(tinggi, kecil);
  FuzzyRuleConsequent *thente = new FuzzyRuleConsequent();
  thente->addOutput(te);
  FuzzyRule *fuzzyRule7 = new FuzzyRule(7, tinggiAndkecil, thente);
  fuzzy->addFuzzyRule(fuzzyRule7);

  // Building FuzzyRule8
  FuzzyRuleAntecedent *tinggiAndsedangg = new FuzzyRuleAntecedent();
  tinggiAndsedangg->joinWithAND(tinggi, sedangg);
  FuzzyRuleConsequent *thente1 = new FuzzyRuleConsequent();
  thente1->addOutput(te1);
  FuzzyRule *fuzzyRule8 = new FuzzyRule(8, tinggiAndsedangg, thente1);
  fuzzy->addFuzzyRule(fuzzyRule8);

  // Building FuzzyRule9
  FuzzyRuleAntecedent *tinggiAndbesar = new FuzzyRuleAntecedent();
  tinggiAndbesar->joinWithAND(tinggi, besar);
  FuzzyRuleConsequent *thence2 = new FuzzyRuleConsequent();
  thence2->addOutput(ce2);
  FuzzyRule *fuzzyRule9 = new FuzzyRule(9, tinggiAndbesar, thence2);
  fuzzy->addFuzzyRule(fuzzyRule9);
}

void loop()
{

  // Getting a random value
  fuzzy->setInput(1, 18.704);
  fuzzy->setInput(2, 168);
  fuzzy->fuzzify();
  // Running the Defuzzification
  float output = fuzzy->defuzzify(1);
  // Printing something
  Serial.print("IKE: ");
  Serial.println(output);

  if (output < 3.05) {
    Serial.println("Status: Termasuk Efisien");
  } else if (output >= 3.05 && output <= 5.34) {
    Serial.println("Status: Termasuk Cukup Efisien");
  } else {
    Serial.println("Status: Termasuk Tidak Efisien");
  }
  // wait 12 seconds
  delay(12000);
}
