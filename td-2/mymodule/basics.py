# -*- coding: utf-8 -*-
'''
values.py
Fonctions mathématiques de base.
'''
def valeur_abs(x):
    if x >= 0:
        y = x
    else:
        y = -x
    return y


def fact(n):
    F = 1
    for k in range(1, n+1):
        F = F * k
    return F
