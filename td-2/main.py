#!/usr/bin/env python3
# -*- coding: utf-8 -*-
'''
Docstring for main
Programme principal qui utilise les modules de la bibliothèque mylib.
'''
import mymodule.basics as basics
from mymodule.basics import valeur_abs, fact
from monnaie import euro_to_dollar
from geometry import volume_boule, volume_cube, volume_cylindre
from mymodule.tortue import Tortue

# Call math functions
print("------------- mylib.math --------------")
print("Valeur absolue de -5 :", valeur_abs(-5))
print("Doit afficher zéro :", valeur_abs(-1.2) - valeur_abs(3 * 0.4))
print("3! x 4! =", fact(3) * fact(4))

print("")   
print("------------- mylib.money --------------")
montant = 150.0
print(montant, "€ =", round(euro_to_dollar(montant), 2), "$")

print("")
print("------------- mylib.money --------------")
print("Volume d'un cube de côté 2 m :",
      volume_cube(2), "m^3")
print("Volume d'une boule de rayon 1 mm :",
      round(volume_boule(1), 3), "mm^3")
print("Volume d'un cylindre de rayon 2 cm et de hauteur 5 cm :",
      round(volume_cylindre(2, 5), 3), "cm^3")

print("")
print("------------- mylib.tortue --------------")
tortue = Tortue('Caroline')
tortue.parler()
tortue.avancer(2)
tortue.parler()
