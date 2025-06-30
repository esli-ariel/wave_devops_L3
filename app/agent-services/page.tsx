"use client"

import { Button } from "@/components/ui/button"
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { ArrowLeft, QrCode, MapPin, Phone, Clock, Star, AlertCircle, Download, Upload } from "lucide-react"
import Link from "next/link"

export default function AgentServicesPage() {
  const nearbyAgents = [
    {
      name: "Boutique Aya",
      address: "Cocody, Riviera 2",
      distance: "0.5 km",
      rating: 4.8,
      services: ["Dépôt", "Retrait", "Transfert"],
      hours: "7h - 22h",
      phone: "+225 07 XX XX XX 01",
    },
    {
      name: "Kiosque Koffi",
      address: "Yopougon, Selmer",
      distance: "1.2 km",
      rating: 4.6,
      services: ["Dépôt", "Retrait"],
      hours: "6h - 20h",
      phone: "+225 05 XX XX XX 02",
    },
    {
      name: "Pharmacie Moderne",
      address: "Plateau, Zone 4",
      distance: "2.1 km",
      rating: 4.9,
      services: ["Dépôt", "Retrait", "Transfert", "Factures"],
      hours: "8h - 19h",
      phone: "+225 01 XX XX XX 03",
    },
  ]

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center h-16">
            <Button variant="ghost" size="icon" asChild>
              <Link href="/dashboard">
                <ArrowLeft className="h-5 w-5" />
              </Link>
            </Button>
            <h1 className="ml-4 text-xl font-semibold text-gray-900">Services Agent</h1>
          </div>
        </div>
      </header>

      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
        {/* My Agent QR Code */}
        <Card>
          <CardHeader>
            <CardTitle className="flex items-center space-x-2">
              <QrCode className="h-5 w-5 text-blue-600" />
              <span>Mon QR Code Agent</span>
            </CardTitle>
            <CardDescription>Présentez ce code aux agents Wave pour vos transactions</CardDescription>
          </CardHeader>
          <CardContent>
            <div className="bg-gradient-to-r from-blue-600 to-purple-600 p-6 rounded-lg text-white">
              <div className="flex items-center space-x-6">
                <div className="w-32 h-32 bg-white rounded-lg flex items-center justify-center">
                  <QrCode className="h-24 w-24 text-blue-600" />
                </div>
                <div className="flex-1">
                  <h3 className="text-xl font-bold mb-2">Kouame Jean</h3>
                  <p className="text-blue-100 mb-1">+225 07 XX XX XX XX</p>
                  <p className="text-sm text-blue-200 mb-3">
                    ID: WV-{Math.random().toString(36).substr(2, 8).toUpperCase()}
                  </p>
                  <div className="flex space-x-2">
                    <Badge className="bg-white/20 text-white">Compte vérifié</Badge>
                    <Badge className="bg-white/20 text-white">Limite: 500K/jour</Badge>
                  </div>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        {/* Services Available */}
        <Card>
          <CardHeader>
            <CardTitle>Services disponibles</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="flex items-center space-x-4 p-4 border rounded-lg">
                <div className="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                  <Download className="h-6 w-6 text-green-600" />
                </div>
                <div>
                  <h3 className="font-semibold">Dépôt d'argent</h3>
                  <p className="text-sm text-gray-600">Alimentez votre compte Wave</p>
                </div>
              </div>
              <div className="flex items-center space-x-4 p-4 border rounded-lg">
                <div className="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                  <Upload className="h-6 w-6 text-red-600" />
                </div>
                <div>
                  <h3 className="font-semibold">Retrait d'argent</h3>
                  <p className="text-sm text-gray-600">Retirez de l'argent liquide</p>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        {/* Security Notice */}
        <Card>
          <CardContent className="pt-6">
            <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
              <div className="flex items-start space-x-3">
                <AlertCircle className="h-5 w-5 text-yellow-600 mt-0.5" />
                <div className="text-sm">
                  <p className="font-medium text-yellow-800 mb-2">Consignes de sécurité</p>
                  <ul className="text-yellow-700 space-y-1">
                    <li>• Vérifiez toujours l'identité de l'agent Wave</li>
                    <li>• Ne partagez jamais votre code PIN</li>
                    <li>• Conservez vos reçus de transaction</li>
                    <li>• Signalez tout comportement suspect</li>
                  </ul>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>

        {/* Nearby Agents */}
        <Card>
          <CardHeader>
            <div className="flex justify-between items-center">
              <CardTitle className="flex items-center space-x-2">
                <MapPin className="h-5 w-5" />
                <span>Agents à proximité</span>
              </CardTitle>
              <Button variant="outline" size="sm">
                Actualiser
              </Button>
            </div>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {nearbyAgents.map((agent, index) => (
                <div key={index} className="border rounded-lg p-4">
                  <div className="flex justify-between items-start mb-3">
                    <div>
                      <h3 className="font-semibold">{agent.name}</h3>
                      <p className="text-sm text-gray-600 flex items-center">
                        <MapPin className="h-3 w-3 mr-1" />
                        {agent.address} • {agent.distance}
                      </p>
                    </div>
                    <div className="flex items-center space-x-1">
                      <Star className="h-4 w-4 text-yellow-500 fill-current" />
                      <span className="text-sm font-medium">{agent.rating}</span>
                    </div>
                  </div>

                  <div className="flex flex-wrap gap-2 mb-3">
                    {agent.services.map((service, serviceIndex) => (
                      <Badge key={serviceIndex} variant="secondary">
                        {service}
                      </Badge>
                    ))}
                  </div>

                  <div className="flex justify-between items-center text-sm text-gray-600">
                    <div className="flex items-center">
                      <Clock className="h-3 w-3 mr-1" />
                      {agent.hours}
                    </div>
                    <div className="flex items-center">
                      <Phone className="h-3 w-3 mr-1" />
                      {agent.phone}
                    </div>
                  </div>

                  <div className="flex space-x-2 mt-3">
                    <Button size="sm" className="flex-1">
                      Itinéraire
                    </Button>
                    <Button size="sm" variant="outline" className="flex-1">
                      Appeler
                    </Button>
                  </div>
                </div>
              ))}
            </div>
          </CardContent>
        </Card>
      </div>
    </div>
  )
}
