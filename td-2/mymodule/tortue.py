# -*- coding: utf-8 -*-
'''
Docstring for tortue
Module définissant la classe Tortue.
'''
class Tortue:
  
    def __init__(self, nom):
        self.nom = nom
        self.position = 0

    def avancer(self, delta):
        self.position += delta

    def get_position(self):
        return self.position

    def parler(self):
        print("Je suis", self.nom, "et je dors à la position", self.position, "!")
