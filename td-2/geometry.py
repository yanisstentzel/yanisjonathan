# -*- coding: utf-8 -*-
'''
Docstring for geometry
Module fournissant des fonctions de calcul de volumes.
'''
from math import pi

def volume_cube(a):
    return a**3


def volume_boule(r):
    return 4/3 * pi * r**3


def volume_cylindre(r, h):
    return pi * r**2 * h
