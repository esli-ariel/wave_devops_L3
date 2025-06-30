"use client"

import { useState } from "react"
import { Button } from "@/components/ui/button"
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card"
import { Badge } from "@/components/ui/badge"
import { ArrowLeft, CheckCircle, AlertCircle, Receipt, Download } from "lucide-react"
import Link from "next/link"

export default function PaymentConfirmPage() {
  const [paymentStatus] = useState("success") // success, pending, failed

  const paymentDetails = {
    service: "CIE (Électricité)",
    reference: "123456789",
    amount: 15000,
    fees: 0,
    total: 15000,
    transactionId: "TXN-" + Math.random().toString(36).substr(2, 9).toUpperCase(),
    date: new Date().toLocaleString("fr-FR"),
  }

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center h-16">
            <Button variant="ghost" size="icon" asChild>
              <Link href="/payment">
                <ArrowLeft className="h-5 w-5" />
              </Link>
            </Button>
            <h1 className="ml-4 text-xl font-semibold text-gray-900">Confirmation de paiement</h1>
          </div>
        </div>
      </header>

      <div className="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Status Card */}
        <Card className="mb-6">
          <CardContent className="pt-6">
            <div className="text-center">
              {paymentStatus === "success" && (
                <>
                  <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <CheckCircle className="h-10 w-10 text-green-600" />
                  </div>
                  <h2 className="text-2xl font-bold text-green-800 mb-2">Paiement réussi !</h2>
                  <p className="text-gray-600">Votre paiement a été traité avec succès</p>
                </>
              )}
              {paymentStatus === "pending" && (
                <>
                  <div className="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <AlertCircle className="h-10 w-10 text-yellow-600" />
                  </div>
                  <h2 className="text-2xl font-bold text-yellow-800 mb-2">Paiement en cours</h2>
                  <p className="text-gray-600">Votre paiement est en cours de traitement</p>
                </>
              )}
              {paymentStatus === "failed" && (
                <>
                  <div className="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <AlertCircle className="h-10 w-10 text-red-600" />
                  </div>
                  <h2 className="text-2xl font-bold text-red-800 mb-2">Paiement échoué</h2>
                  <p className="text-gray-600">Une erreur s'est produite lors du paiement</p>
                </>
              )}
            </div>
          </CardContent>
        </Card>

        {/* Payment Details */}
        <Card className="mb-6">
          <CardHeader>
            <CardTitle className="flex items-center space-x-2">
              <Receipt className="h-5 w-5" />
              <span>Détails du paiement</span>
            </CardTitle>
          </CardHeader>
          <CardContent className="space-y-4">
            <div className="bg-gray-50 p-4 rounded-lg space-y-3">
              <div className="flex justify-between">
                <span className="text-gray-600">Service</span>
                <span className="font-medium">{paymentDetails.service}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-600">Référence</span>
                <span className="font-medium">{paymentDetails.reference}</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-600">Montant</span>
                <span className="font-medium">{paymentDetails.amount.toLocaleString()} FCFA</span>
              </div>
              <div className="flex justify-between">
                <span className="text-gray-600">Frais</span>
                <span className="font-medium">{paymentDetails.fees} FCFA</span>
              </div>
              <div className="border-t pt-3">
                <div className="flex justify-between">
                  <span className="font-semibold">Total payé</span>
                  <span className="font-bold text-lg">{paymentDetails.total.toLocaleString()} FCFA</span>
                </div>
              </div>
            </div>

            <div className="space-y-2">
              <div className="flex justify-between text-sm">
                <span className="text-gray-600">ID Transaction</span>
                <span className="font-mono">{paymentDetails.transactionId}</span>
              </div>
              <div className="flex justify-between text-sm">
                <span className="text-gray-600">Date et heure</span>
                <span>{paymentDetails.date}</span>
              </div>
              <div className="flex justify-between text-sm">
                <span className="text-gray-600">Statut</span>
                <Badge
                  className={
                    paymentStatus === "success"
                      ? "bg-green-100 text-green-800"
                      : paymentStatus === "pending"
                        ? "bg-yellow-100 text-yellow-800"
                        : "bg-red-100 text-red-800"
                  }
                >
                  {paymentStatus === "success" ? "Confirmé" : paymentStatus === "pending" ? "En cours" : "Échoué"}
                </Badge>
              </div>
            </div>
          </CardContent>
        </Card>

        {/* Actions */}
        <div className="space-y-4">
          <Button className="w-full">
            <Download className="h-4 w-4 mr-2" />
            Télécharger le reçu
          </Button>

          <div className="grid grid-cols-2 gap-4">
            <Button variant="outline" asChild>
              <Link href="/payment">Nouveau paiement</Link>
            </Button>
            <Button variant="outline" asChild>
              <Link href="/dashboard">Retour au dashboard</Link>
            </Button>
          </div>
        </div>

        {/* Support */}
        {paymentStatus === "failed" && (
          <Card className="mt-6">
            <CardContent className="pt-6">
              <div className="text-center">
                <h3 className="font-semibold mb-2">Besoin d'aide ?</h3>
                <p className="text-sm text-gray-600 mb-4">
                  Si vous rencontrez des difficultés, notre équipe support est là pour vous aider.
                </p>
                <Button variant="outline">Contacter le support</Button>
              </div>
            </CardContent>
          </Card>
        )}
      </div>
    </div>
  )
}
